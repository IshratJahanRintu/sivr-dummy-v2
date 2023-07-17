<?php

namespace App\Http\Controllers;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $this->sivrPageElementService->createItem($request);
        return redirect(route('sivr-pages.index'));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
