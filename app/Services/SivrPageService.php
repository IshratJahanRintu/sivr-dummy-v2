<?php

namespace App\Services;

use App\Models\SivrPage;
use App\Repositories\SivrPageRepository;
use App\Traits\FileUploadTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SivrPageService
{
    use FileUploadTrait;

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


    public function storeAudio($request)
    {
        $data = [];
        $rules = [
            'audio_file_ban' => 'file|max:10240',
            'audio_file_en' => 'file|max:10240',
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
        function validateLength($maxLength, $file)
        {
            return strlen($file->getClientOriginalName()) <= $maxLength;
        }

        $audio_file_ban = $request->file('audio_file_ban');
        $audio_file_en = $request->file('audio_file_en');
        if ($audio_file_ban) {
            if (validateLength(30, $audio_file_ban)) {
                $this->uploadAndStoreFile($audio_file_ban, 'audio_file_ban', 'audio_files', $data);
            } else {
                return (object)[
                    'status' => '424',
                    'messages' => 'Audio file names should not exceed 25 characters.',
                    'data' => $sivrPage,
                ];
            }
        }
        if ($audio_file_en) {
            if (validateLength(30, $audio_file_en)) {
                $this->uploadAndStoreFile($audio_file_en, 'audio_file_en', 'audio_files', $data);
            } else {
                return (object)[
                    'status' => '424',
                    'messages' => 'Audio file names should not exceed 25 characters.',
                    'data' => $sivrPage,
                ];
            }
        }

        DB::beginTransaction();

        try {
            $this->sivrPageRepository->storeAudio($data, $sivrPage);
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

        DB::beginTransaction();

        try {

             $this->sivrPageRepository->create($data);

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

    public function deleteAudio($request, SivrPage $sivrPage)
    {

        $data = $request->all();
        function deleteAudioFile($filename)
        {
            $filePath = 'public/' . $filename;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            } else {
                dd('File not found');
            }
        }

        DB::beginTransaction();
        try {

            $this->sivrPageRepository->deleteAudio($data, $sivrPage);
            deleteAudioFile($data['audioFile']);

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
            'status' => 209,
            'messages' => config('status.status_code.209'),
            'data' => $sivrPage,
        ];

    }

}
