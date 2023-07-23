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
        return view('sivr.PageElements.create');
    }


    public function store(Request $request)
    {

        $result = $this->sivrPageElementService->createItem($request);
        if ($result->status == 201) {
            session()->flash('success', 'Record ' . $result->messages . ' successfully!');
        } else {
            session()->flash('error', 'Can not Create !');
            return redirect()->route('sivr-page-elements.create')->withInput()->withErrors($result->validator ?? $result->messages);

        }
        return redirect(route('sivr-page-elements.show', ['sivr_page_element' => session('sivrPage')]));
    }


    public function show(SivrPage $sivr_page_element)
    {

        return view('sivr.PageElements.index', ['sivrPage' => $sivr_page_element]);
    }

    public function edit(SivrPageElement $sivr_page_element)
    {

        return view('sivr.PageElements.edit', compact('sivr_page_element'));
    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
    public function update(Request $request, SivrPageElement $sivrPageElement)
    {

        $result = $this->sivrPageElementService->updateItem($request, $sivrPageElement);
        if ($result->status == 208) {
            session()->flash('success', 'Sivr Page Element'. $result->messages. ' successfully!');

        } else {
            session()->flash('error', 'Cannot Edit !');
            return redirect()->route('sivr-page-elements.edit',['sivr_page_element' => $sivrPageElement])->withInput()->withErrors($result->validator??$result->error);
        }
        return redirect(route('sivr-page-elements.show', ['sivr_page_element' => session('sivrPage')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(SivrPageElement $sivrPageElement)
    {
       $result= $this->sivrPageElementService->deleteItem($sivrPageElement);
        if($result->status == 209){

            session()->flash('success', 'Record '. $result->messages. ' successfully!');

        }else{

            session()->flash('error', 'Can not Delete !');
        }
        return redirect(route('sivr-page-elements.show', ['sivr_page_element' => session('sivrPage')]));
    }
}
