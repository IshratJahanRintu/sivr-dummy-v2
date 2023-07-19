<?php

namespace App\Services;

use App\Repositories\SivrPageElementRepository;
use Exception;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SivrPageElementService
{
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
            'display_name_en'=>'required|max:50|string',
            'display_name_bn'=>'required|max:50|string',
            'page_id' => 'required|numeric',
            'type' => 'required',
            'background_color'=>'required' ,
            'text_color'=>'required',
            'element_order'=>'required|numeric|min:1',
            'is_visible'=>'required|string|min:1|max:1',
            'data_provider_function'=>'required|string|max:20' ,
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
        $data   = $request->all();

//         return $data;

        DB::beginTransaction();

        try {

           $this->sivrPageElementRepository->create($data);

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return (object)[
                'status'            => 424,
                'messages'          => config('status.status_code.424'),
                'error'             => $e->getMessage()
            ];
        }

        DB::commit();

        return (object)[
            'status'                => 201,
            'messages'              => config('status.status_code.201'),

        ];
    }

    public function updateItem( $request,$sivrPageElement)
    {


        $data = $request->all();

        DB::beginTransaction();

        try{

            $this->sivrPageElementRepository->update($data, $sivrPageElement);


        } catch (Exception $e) {

            DB::rollBack();
            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return (object)[
                'status'            => 424,
                'messages'          => config('status.status_code.424'),
                'errors'            => [$e->getMessage()]
            ];
        }

        DB::commit();

        return (object)[
            'status'                => 208,
            'messages'              => config('status.status_code.208'),

        ];

    }

    public function deleteItem($sivrPageElement)
    {

        DB::beginTransaction();

        try{

            $delete = $this->sivrPageElementRepository->deleteItem($sivrPageElement);
            if( $delete<1 ){
                return (object)[
                    'status'    => 404,
                    'messages'   => config('status.status_code.404')
                ];
            }

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return (object)[
                'status'    => 424,
                'messages'   => config('status.status_code.424'),
                'error'     => $e->getMessage()
            ];
        }

        DB::commit();

        return (object)[
            'status'    => 209,
            'messages'   => config('status.status_code.209'),
            'data'      => $delete
        ];

    }

}
