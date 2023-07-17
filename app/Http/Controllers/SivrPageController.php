<?php

namespace App\Http\Controllers;

use App\Models\SivrPage;
use App\Services\SivrPageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class SivrPageController extends Controller
{
    protected $sivrPageService;

    function __construct()
    {
        $this->sivrPageService = new SivrPageService();
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    function index()
    {

        $result = $this->sivrPageService->listItems();

        if ($result->status == 200) {
            $data = $result->data;
            $sivrPages = $data[0];
            $allPages = $data[1];
            $sivrPagesJson = $allPages->toJson();
            return view('sivr.sivrPages.index', compact('sivrPages', 'sivrPagesJson'));

        }
        }



        /**
         * Store a newly created resource in storage.
         *
         * @param Request $request
         *
         */
        public
        function store(Request $request)
        {

            $result = $this->sivrPageService->createItem($request);
            if($result->status == 201){
                session()->flash('success', 'Record '. $result->messages. ' successfully!');
            }else{
                session()->flash('error', 'Can not Create !');
            }

            return redirect(route('sivr-pages.index'));
        }

        public function saveAudio(Request $request)
        {
            $pageId = $request->page_id;
            $sivrPage = SivrPage::find($pageId);
            $audio_file_ban = $request->file('audio_file_ban');
            $audio_file_en = $request->file('audio_file_en');

            // Validate and store the audio files
            if ($audio_file_ban && $audio_file_en) {
                $path_ban = $audio_file_ban->storeAs('audio_files', $audio_file_ban->getClientOriginalName());
                $path_en = $audio_file_en->storeAs('audio_files', $audio_file_en->getClientOriginalName());


                // Save the file paths to the database
                $updated = $sivrPage->update([
                    'audio_file_ban' => $path_ban,
                    'audio_file_en' => $path_en,
                ]);
                if ($updated) {

                    return redirect()->back();
                } else {
                    echo "audio file upload failed";
                }

            }

            return redirect()->back()->withErrors('Please upload both audio files.');
        }


        /**
         * Display the specified resource.
         *
         * @param int $id
         * @return Response
         */
        public
        function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         * @return Response
         */
        public
        function edit(Request $request)
        {

        }


        public
        function update(Request $request, SivrPage $sivrPage)
        {

            $updated =$this->sivrPageService->updateItem($request,$sivrPage);
            if ($updated) {
                return back();
            }
        }

        /**
         * Remove the specified resource from storage.
         *
         *
         */
        public
        function destroy(SivrPage $sivrPage)
        {
            $result = $this->sivrPageService->deleteItem($sivrPage);

            if($result->status == 209){

                session()->flash('success', 'Record '. $result->messages. ' successfully!');

            }else{

                session()->flash('error', 'Can not Delete !');
            }
            return redirect(route('sivr-pages.index'));
        }
    }







