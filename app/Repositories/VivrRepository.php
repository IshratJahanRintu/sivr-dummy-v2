<?php

namespace App\Repositories;

use App\Models\Vivr;

class VivrRepository
{
    public function listing()
    {

        return Vivr::all();



    }


    public function create(array $data)
    {

        Vivr::query()->create([

            'title' => $data['vivr_title'],


        ]);

    }

//    public function update(array $data, SivrPage $sivrPage)
//    {
//        $updated = $sivrPage->update([
//
//
//            'vivr_id' => $data['vivr_id'],
//            'page_heading_ban' => $data['page_heading_ban'],
//            'page_heading_en' => $data['page_heading_en'],
//            'task' =>$data['task'],
//            'has_previous_menu' =>$data['has_previous_menu'],
//            'has_main_menu' => $data['has_main_menu'],
//            'service_title_id' =>$data['service_title_id'],
//
//        ]);
//        return $updated;
//
//    }

    public function deleteItem(Vivr $vivr)
    {

        return $vivr->forceDelete();

    }


}
