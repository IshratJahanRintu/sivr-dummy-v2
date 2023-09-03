<?php

namespace App\Repositories;

use App\Models\SivrPage;

class SivrPageRepository
{


    public function listing()
    {


        $allSivrPages = SivrPage::with('children', 'pageElements')->get();
        $ParentSivrPages = $allSivrPages->where('parent_page_id', null);
        return [$ParentSivrPages, $allSivrPages];
    }


    public function create(array $data)
    {

        SivrPage::query()->create([

            'parent_page_id' => $data['parent_page_id']??null,
            'vivr_id' => $data['vivr_id'],
            'page_heading_ban' => $data['page_heading_ban'],
            'page_heading_en' => $data['page_heading_en'],
            'task' => $data['task'],
            'has_previous_menu' => $data['has_previous_menu'],
            'has_main_menu' => $data['has_main_menu'],
            'service_title_id' => $data['service_title_id'],

        ]);

    }

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

    public function storeAudio(array $data,SivrPage $sivrPage){

         $sivrPage->update([
            'audio_file_ban' => $data['audio_file_ban']??$sivrPage->audio_file_ban,
            'audio_file_en' => $data['audio_file_en']??$sivrPage->audio_file_en,
        ]);

        return $sivrPage;
    }

    public function deleteAudio(array $data, SivrPage $sivrPage)
    {
        if ($data['fileType'] === 'bangla') {
            $sivrPage->update(['audio_file_ban' => null]);
        } elseif ($data['fileType'] === 'english') {
            $sivrPage->update(['audio_file_en' => null]);
        }
    }

}
