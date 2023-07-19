<?php

namespace App\Http\Controllers;

use App\Models\SivrPage;
use App\Models\SivrPageElement;
use App\Services\SivrPageElementService;
use Illuminate\Http\Request;

class SivrPageElementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $sivrPageElementService;

    function __construct()
    {
        $this->sivrPageElementService = new SivrPageElementService();
    }

    public function index()
    {

    }


    public function create()
    {
        return  view('sivr.PageElements.create');
    }


    public function store(Request $request)
    {

      $result=  $this->sivrPageElementService->createItem($request);
        if($result->status == 201){
            session()->flash('success', 'Record '. $result->messages. ' successfully!');
        }else{
            session()->flash('error', 'Can not Create !');
            return redirect()->route('sivr-page-elements.create')->withInput()->withErrors($result->validator??$result->error);

        }
        return redirect(route('sivr-page-elements.show',['sivr_page_element'=> session('sivrPage')]));
    }



    public function show( SivrPage $sivr_page_element)
    {

        return view('sivr.PageElements.index',['sivrPage'=>$sivr_page_element]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
    public function update(Request $request, SivrPageElement $sivrPageElement)
    {

        $updated =$this->sivrPageElementService->updateItem($request,$sivrPageElement);
        if ($updated) {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(SivrPageElement $sivrPageElement)
    {
       $this->sivrPageElementService->deleteItem($sivrPageElement);
        return redirect(route('sivr-pages.index'));
    }
}
