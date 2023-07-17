<?php

namespace App\Services;

use App\Models\SivrPage;
use App\Repositories\SivrPageRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        try{

            $listing = $this->sivrPageRepository->listing();


        }catch (Exception $e) {

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
            'status'                => 200,
            'messages'              => config('status.status_code.200'),
            'data'                  => $listing
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
    public function createItem($request)
    {
//        $rules = [
//            'business_name'     => 'required|string|max:50|min:2',
//            'email'             => 'nullable|email|string|max:30',
//            'contact_phone'     => 'nullable|numeric|digits_between:10,15',
//            'expire_date'       => 'required|date',
//            'seat'              => 'required|numeric'
//        ];
//
//        Validator::make($request->all(),$rules)->validate();

        $data   = $request->all();


//         return $data;

        DB::beginTransaction();

        try {

            $id = $this->sivrPageRepository->create($data);

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

    public function updateItem($request,SivrPage $sivrPage)
    {

//        $rules = [
//            'business_name'     => 'required|string|max:50|min:2',
//            'email'             => 'nullable|email|string|max:30',
//            'contact_phone'     => 'nullable|numeric|digits_between:10,15',
//            'expire_date'       => 'required|date',
//            'seat'              => 'required|numeric'
//        ];
//
//
//        Validator::make($request->all(),$rules)->validate();

        $data = $request->all();
        DB::beginTransaction();

        try{

            $this->sivrPageRepository->update($data, $sivrPage);


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

    public function deleteItem(SivrPage $sivrPage)
    {

        DB::beginTransaction();

        try{

            $delete = $this->sivrPageRepository->deleteItem($sivrPage);

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
