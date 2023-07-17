<?php

namespace App\Repositories;

use App\Models\SivrPage;

class SivrPageRepository
{


    public function listing()
    {
        $result = [];
        $ParentSivrPages = SivrPage::with('children')->whereNull('parent_page_id')->get();
        $allSivrPages = SivrPage::with('children', 'pageElements')->get();
        $result[] = $ParentSivrPages;
        $result[] = $allSivrPages;
        return $result;

    }

//    public function getMaxId()
//    {
//
//        return SocialMedia::max('id');
//
//    }
//
//    public function show($id)
//    {
//
//        return SocialMedia::findorfail($id);
//
//    }
//
//    public function getPageInfo($id)
//    {
//
//        return SocialMedia::where('page_id', $id)->first();
//
//    }
//
    public function create(array $data)
    {

        SivrPage::query()->create([

            'parent_page_id' => $data['parent_page_id'],
            'vivr_id' => $data['vivr_id'],
            'page_heading_ban' => $data['page_heading_ban'],
            'page_heading_en' => $data['page_heading_en'],
            'task' => $data['task'],
            'has_previous_menu' => $data['has_previous_menu'],
            'has_main_menu' => $data['has_main_menu'],
            'service_title_id' => $data['service_title_id'],

        ]);
        return $data['parent_page_id'];
    }
//
//
    public function update(array $data, SivrPage $sivrPage)
    {
        $updated = $sivrPage->update([


            'vivr_id' => $data['vivr_id'],
            'page_heading_ban' => $data['page_heading_ban'],
            'page_heading_en' => $data['page_heading_en'],
            'task' =>$data['task'],
            'has_previous_menu' =>$data['has_previous_menu'],
            'has_main_menu' => $data['has_main_menu'],
            'service_title_id' =>$data['service_title_id'],

        ]);
        return $updated;

    }

    public function deleteItem(SivrPage $sivrPage)
    {

       return $sivrPage->forceDelete();

    }

    public function storeAudio(array $data){

    }

}
