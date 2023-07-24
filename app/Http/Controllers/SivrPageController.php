<?php

namespace App\Http\Controllers;

use App\Models\SivrPage;
use App\Services\SivrPageService;
use Illuminate\Database\Eloquent\Collection;
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

            return view('sivr.sivrPages.index', compact('sivrPages', 'allPages'));

        }
    }

    public function create()
    {
        $result = $this->sivrPageService->listItems();

        if ($result->status == 200) {
            $data = $result->data;
            $sivrPages = $data[1];


            return view('sivr.sivrPages.create', compact('sivrPages'));
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
        if ($result->status == 201) {
            session()->flash('success', 'Record ' . $result->messages . ' successfully!');
        } else {
            session()->flash('error', 'Can not Create !');
            return redirect()->route('sivr-pages.create')->withInput()->withErrors($result->validator ?? '');

        }

        return redirect(route('sivr-pages.index'));
    }

    public function uploadAudio(SivrPage $sivrPage = null)
    {
        $allPages = null;
        $result = $this->sivrPageService->listItems();

        if ($result->status == 200) {
            $data = $result->data;
            $allPages = $data[1];
        }
        else{
            dd('No data found');
        }
        return view('sivr.sivrPages.audioUpload', ['sivrPage'=>$sivrPage,'allPages'=>$allPages]);


    }

    public function saveAudio(Request $request)
    {
        $result=$this->sivrPageService->storeAudio($request);
       if ($result->status == 201) {
            session()->flash('success', 'Audio uploaded successfully!');
        } else {
            session()->flash('error', 'Can not Upload Audio!');
           return redirect()->back()->withErrors($result->validator ?? $result->messages)->withInput();

       }

        return redirect(route('sivr-pages.index'));
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
     *
     */
    public
    function edit(SivrPage $sivrPage)
    {
        return view('sivr.sivrPages.edit', compact('sivrPage'));
    }


    public
    function update(Request $request, SivrPage $sivrPage)
    {

        $result = $this->sivrPageService->updateItem($request, $sivrPage);

        if ($result->status == 208) {
            session()->flash('success', 'Sivr Page ' . $result->messages . ' successfully!');
            return redirect(route('sivr-pages.index'));
        } else {
            session()->flash('error', 'Cannot Edit !');
            return redirect()->route('sivr-pages.edit', $sivrPage)->withInput()->withErrors($result->validator ?? $result->messages);
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

        if ($result->status == 209) {

            session()->flash('success', 'Record ' . $result->messages . ' successfully!');

        } else {

            session()->flash('error', 'Can not Delete !');
        }
        return redirect(route('sivr-pages.index'));
    }
}







