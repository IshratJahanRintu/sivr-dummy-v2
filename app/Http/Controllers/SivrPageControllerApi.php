<?php

namespace App\Http\Controllers;

use App\Models\SivrPage;
use App\Services\SivrPageService;
use App\Services\VivrService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SivrPageControllerApi extends Controller
{
    protected $sivrPageService;
    protected $vivrService;

    function __construct()
    {
        $this->sivrPageService = new SivrPageService();
        $this->vivrService = new VivrService();
    }

    public function getRootPage($vivrId)
    {

        function buildNestedStructure(&$parentPage)
        {
            $children = $parentPage->children;


            if ($children->isEmpty()) {
                return [];
            }

            return $children->map(function ($child) {
                $nestedChildren = buildNestedStructure($child);

                return [
                    'page_elements' => $child->pageElements,
                    'id' => $child->id,
                    'parent_page_id' => $child->parent_page_id,
                    'vivr_id' => $child->vivr_id,
                    'page_heading_ban' => $child->page_heading_ban,
                    'page_heading_en' => $child->page_heading_en,
                    'task' => $child->task,
                    'has_previous_menu' => $child->has_previous_menu,
                    'has_main_menu' => $child->has_main_menu,
                    'audio_file_ban' => $child->audio_file_ban,
                    'audio_file_en' => $child->audio_file_en,
                    'service_title_id' => $child->service_title_id,
                    'children' => $nestedChildren
                ];
            });
        }

        $result = $this->sivrPageService->listItems($vivrId);

        if ($result->status == 200) {
            $allPages = $result->data;
            $rootPage = $allPages->where('parent_page_id', null);
            buildNestedStructure($rootPage[0]);
            return $rootPage;
        }
    }


    public function getAllPages($vivrId)
    {

        return $result = $this->sivrPageService->listItems($vivrId);
    }
    public function store(Request $request)
    {
        return   $this->sivrPageService->createItem($request);
    }

    public function update(Request $request, $id)
    {
        $sivrPage = SivrPage::find($id);
        return  $this->sivrPageService->updateItem($request, $sivrPage);
    }

    public function destroy($id)
    {

        $sivrPage = SivrPage::find($id);
        return  $result = $this->sivrPageService->deleteItem($sivrPage);
    }

    public function saveAudio(Request $request)
    {

        return $result = $this->sivrPageService->storeAudio($request);
    }
}
