<?php

namespace App\Http\Controllers;

use App\Models\Vivr;
use App\Services\VivrService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VivrController extends Controller
{
    public function __construct()
    {
        $this->vivrService = new VivrService();
    }

    public function index()
    {
        $result = $this->vivrService->listItems();
        if ($result->status == 200) {
            $vivrList = $result->data;

        }
        return view('sivr.vivr.index', ['vivrList' => $vivrList]);
    }


    public function create()
    {
        if (Auth::check()) {
            return view('sivr.vivr.create');
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }


    public function store(Request $request)
    {
        if (Auth::check()) {
            $result = $this->vivrService->createItem($request);
            if ($result->status == 201) {
                session()->flash('success', 'Record ' . $result->messages . ' successfully!');
            } else {
                session()->flash('error', 'Can not Create !');
                return redirect()->route('vivr.create')->withInput()->withErrors($result->validator ?? '');

            }

            return redirect(route('vivr.index'));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Vivr $vivr)
    {
        if (Auth::check()) {
            $result = $this->vivrService->deleteItem($vivr);

            if ($result->status == 209) {

                session()->flash('success', 'Record ' . $result->messages . ' successfully!');

            } else {

                session()->flash('error', 'Can not Delete !');
            }
            return redirect(route('vivr.index'));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

}
