<?php

namespace App\Services;

use App\Models\Vivr;
use App\Repositories\VivrRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class VivrService
{

    protected $vivrRepository;

    public function __construct()
    {

        $this->vivrRepository = new VivrRepository();

    }


    public function listItems()
    {



        try {

            $listing = $this->vivrRepository->listing();


        } catch (Exception $e) {


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





    public function createItem(Request $request)
    {
        $rules = [
            'vivr_title'=>'required|string|max:50|unique:vivr,title'
        ];
$messages=[
    'vivr_title.unique'=>'Vivr Tilte must be unique'
];
        $validator = Validator::make($request->all(), $rules,$messages);

        if ($validator->fails()) {
            // Redirect back to the edit form with errors and old input
            return (object)[
                'status' => '424',
                'validator' => $validator,
                'messages' => config('status.status_code.424'),
            ];
        }

        $data = $request->all();



        try {

            $this->vivrRepository->create($data);

        } catch (Exception $e) {

            Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

            return (object)[
                'status' => 424,
                'messages' => config('status.status_code.424'),
                'error' => $e->getMessage()
            ];
        }



        return (object)[
            'status' => 201,
            'messages' => config('status.status_code.201'),

        ];
    }

    public function deleteItem( $vivr)
    {

if ($vivr->sivrPages->count()==0){
    try {


        $delete = $this->vivrRepository->deleteItem($vivr);
        if ($delete < 1) {
            return (object)[
                'status' => 404,
                'messages' => config('status.status_code.404')
            ];
        }

    } catch (Exception $e) {


        Log::error('Found Exception: ' . $e->getMessage() . ' [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $e->getFile() . '-' . $e->getLine() . ']');

        return (object)[
            'status' => 424,
            'messages' => config('status.status_code.424'),
            'error' => $e->getMessage()
        ];
    }



    return (object)[
        'status' => 209,
        'messages' => config('status.status_code.209'),
        'data' => $delete
    ];
}
     else{
         return (object)[
             'status' => 424,
             'messages' => config('status.status_code.424'),

         ];
     }

    }

}
