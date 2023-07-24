<?php

namespace App\Services;

use App\Models\SivrPage;
use App\Repositories\SivrPageRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SivrPageService
{

    protected $sivrPageRepository;

    public function __construct()
    {

        $this->sivrPageRepository = new SivrPageRepository();

    }


    public function listItems()
    {

        DB::beginTransaction();

        try {

            $listing = $this->sivrPageRepository->listing();


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
            'status' => 200,
            'messages' => config('status.status_code.200'),
            'data' => $listing
        ];
    }
//
//    public function showItem($id)
//    {
//
//        DB::beginTransaction();
//
//        try{
//
//            $clientInfo = $this->agentRepository->show($id);
//
//        }catch (Exception $e) {
//
//            DB::rollBack();
//            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');
//
//            return (object)[
//                'status'            => 424,
//                'messages'          => config('status.status_code.424'),
//                'error'             => $e->getMessage()
//            ];
//        }
//
//        DB::commit();
//
//        return (object)[
//            'status'                => 200,
//            'messages'              => config('status.status_code.200'),
//            'data'                  => $clientInfo,
//        ];
//    }
//
//

    public function storeAudio($request)
    {

        $rules = [
            'audio_file_ban' => 'required|file|max:10240',
            'audio_file_en' => 'required|file|max:10240',
        ];
        $pageId = $request->audio_page_id;
        $sivrPage = SivrPage::find($pageId);

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Redirect back to the edit form with errors and old input
            return (object)[
                'status' => '424',
                'validator' => $validator,
                'messages' => config('status.status_code.424'),
                'data' => $sivrPage,
            ];
        }

        $audio_file_ban = $request->file('audio_file_ban');
        $audio_file_en = $request->file('audio_file_en');
        if ($audio_file_ban && $audio_file_en) {
            if (strlen($audio_file_ban->getClientOriginalName()) > 30 || strlen($audio_file_en->getClientOriginalName()) > 30) {
                return (object)[
                    'status' => '424',
                    'messages' => 'Audio file names should not exceed 25 characters.',
                    'data' => $sivrPage,
                ];
            }
            // Validate and store the audio files

            $path_ban = $audio_file_ban->storeAs('audio_files', $audio_file_ban->getClientOriginalName(), 'public');
            $path_en = $audio_file_en->storeAs('audio_files', $audio_file_en->getClientOriginalName(), 'public');
            $data['audio_file_ban'] = $path_ban;
            $data['audio_file_en'] = $path_en;
        }
        DB::beginTransaction();

        try {

            $result = $this->sivrPageRepository->storeAudio($data, $sivrPage);

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return (object)[
                'status' => 424,
                'messages' => config('status.status_code.424'),
                'error' => $e->getMessage(),
                'data' => $sivrPage,
            ];
        }

        DB::commit();

        return (object)[
            'status' => 201,
            'messages' => config('status.status_code.201'),
            'data' => $sivrPage,
        ];
    }


    public function createItem($request)
    {
        $rules = [
            'vivr_id' => 'required|numeric',
            'page_heading_ban' => 'required|string|max:30|min:3',
            'page_heading_en' => 'required|string|max:30|min:3',
            'task' => 'required|string|max:30|min:3',
            'has_previous_menu' => 'required|string|max:1|min:1',
            'has_main_menu' => 'required|string|max:1|min:1',
            'service_title_id' => 'required|numeric',
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


//         return $data;

        DB::beginTransaction();

        try {

            $id = $this->sivrPageRepository->create($data);

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

    public function updateItem($request, SivrPage $sivrPage)
    {

        $rules = [
            'vivr_id' => 'required|numeric',
            'page_heading_ban' => 'required|string|max:30|min:3',
            'page_heading_en' => 'required|string|max:30|min:3',
            'task' => 'required|string|max:30|min:3',
            'has_previous_menu' => 'required|string|max:1|min:1',
            'has_main_menu' => 'required|string|max:1|min:1',
            'service_title_id' => 'required|numeric',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Redirect back to the edit form with errors and old input
            return (object)[
                'status' => 424,
                'messages' => config('status.status_code.424'),
                'validator' => $validator
            ];
        }
        $data = $request->all();
        DB::beginTransaction();

        try {

            $this->sivrPageRepository->update($data, $sivrPage);


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

    public function deleteItem(SivrPage $sivrPage)
    {

        DB::beginTransaction();

        try {

            $delete = $this->sivrPageRepository->deleteItem($sivrPage);

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


}
