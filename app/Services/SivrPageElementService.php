<?php

namespace App\Services;

use App\Models\SivrPageElement;
use App\Repositories\SivrPageElementRepository;
use App\Traits\FileUploadTrait;
use App\Traits\PageElementTrait;
use Exception;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use stdClass;

class SivrPageElementService
{
    use FileUploadTrait;
    use PageElementTrait;

    protected $sivrPageElementRepository;

    public function __construct()
    {

        $this->sivrPageElementRepository = new SivrPageElementRepository();

    }


    public function listItems()
    {


    }

    public function showItem($id)
    {


    }


    public function createItem($request)
    {

        $rules = [
            'display_name_en' => 'string',
            'display_name_bn' => 'string',
            'page_id' => 'required|numeric',
            'type' => 'required',
            'background_color' => 'required',
            'text_color' => 'required',
            'element_order' => 'required|numeric|min:1',
            'is_visible' => 'required|string|min:1|max:1',

            'compare_api_comparison' => 'max:3|min:1',
            'compare_api_transfer_page_id' => 'max:50|min:1',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            // Redirect back to the edit form with errors and old input
            return (object)[
                'status' => '424',
                'validator' => $validator,
                'messages' => config('status.status_code.424'),
            ];
        }
        $data = $request->all();

        $this->createElementProperties($data);

//         return $data;

        DB::beginTransaction();

        try {

            $this->sivrPageElementRepository->create($data);

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return (object)[
                'status' => 424,
                'messages' => config('status.status_code.424'),
                'error' => $e->getMessage()
            ];
        }

        DB::commit();

        return (object)[
            'status' => 201,
            'messages' => config('status.status_code.201'),

        ];
    }

    public function updateItem($request, $sivrPageElement)
    {
        $rules = [
            'display_name_en' => 'string',
            'display_name_bn' => 'string',

            'type' => 'required',
            'background_color' => 'required',
            'text_color' => 'required',
            'element_order' => 'required|numeric|min:1',
            'is_visible' => 'required|string|min:1|max:1',

        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            // Redirect back to the edit form with errors and old input
            return (object)[
                'status' => '424',
                'validator' => $validator,
                'messages' => config('status.status_code.424'),
            ];
        }


        $data = $request->all();
        $this->createElementProperties($data);
        DB::beginTransaction();

        try {

            $this->sivrPageElementRepository->update($data, $sivrPageElement);


        } catch (Exception $e) {

            DB::rollBack();
            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return (object)[
                'status' => 424,
                'messages' => config('status.status_code.424'),
                'errors' => [$e->getMessage()]
            ];
        }

        DB::commit();

        return (object)[
            'status' => 208,
            'messages' => config('status.status_code.208'),

        ];

    }

    public function deleteItem($sivrPageElement)
    {

        DB::beginTransaction();

        try {

            $delete = $this->sivrPageElementRepository->deleteItem($sivrPageElement);
            if ($delete < 1) {
                return (object)[
                    'status' => 404,
                    'messages' => config('status.status_code.404')
                ];
            }

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return (object)[
                'status' => 424,
                'messages' => config('status.status_code.424'),
                'error' => $e->getMessage()
            ];
        }

        DB::commit();

        return (object)[
            'status' => 209,
            'messages' => config('status.status_code.209'),
            'data' => $delete
        ];

    }

    public function storeMenuIcon($request)
    {
        $data = [];
        $rules = [
            'menu_icon' => 'file|max:10240|required',

        ];

        $pageElementId = $request->page_element_id;
        $pageElement = SivrPageElement::find($pageElementId);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return (object)[
                'status' => '424',
                'validator' => $validator,
                'messages' => config('status.status_code.424'),
                'data' => $pageElement,
            ];
        }

        $menu_icon = $request->file('menu_icon');

        if ($menu_icon) {
            $this->uploadAndStoreFile($menu_icon, 'menu_icon', 'menu_icons', $data);
        }


        DB::beginTransaction();

        try {
            $pageElement = $this->sivrPageElementRepository->storeIcon($data, $pageElement);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return (object)[
                'status' => 424,
                'messages' => config('status.status_code.424'),
                'error' => $e->getMessage(),
                'data' => $pageElement,
            ];
        }

        DB::commit();

        return (object)[
            'status' => 201,
            'messages' => config('status.status_code.201'),
            'data' => $pageElement,
        ];

    }


}



