<?php

namespace App\Http\Controllers;

use App\Models\SivrPage;
use App\Models\SivrPageElement;
use App\Services\SivrPageElementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SivrPageElementController extends Controller
{

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
        if (Auth::check()) {
            return view('sivr.PageElements.create');
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }


    public function store(Request $request)
    {
        if (Auth::check()) {
            $result = $this->sivrPageElementService->createItem($request);
            if ($result->status == 201) {
                session()->flash('success', 'Record ' . $result->messages . ' successfully!');
            } else {
                session()->flash('error', 'Can not Create !');
                return redirect()->route('sivr-page-elements.create')->withInput()->withErrors($result->validator ?? $result->messages);

            }
            return redirect(route('sivr-page-elements.show', ['sivr_page_element' => session('sivrPage')]));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }


    public function show(SivrPage $sivr_page_element)
    {
        if (Auth::check()) {
            return view('sivr.PageElements.index', ['sivrPage' => $sivr_page_element]);
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function edit(SivrPageElement $sivr_page_element)
    {
        if (Auth::check()) {
            return view('sivr.PageElements.edit', compact('sivr_page_element'));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Update the specified resource in storage.
     *
     *
     */
    public function update(Request $request, SivrPageElement $sivrPageElement)
    {
        if (Auth::check()) {

            $result = $this->sivrPageElementService->updateItem($request, $sivrPageElement);
            if ($result->status == 208) {
                session()->flash('success', 'Sivr Page Element' . $result->messages . ' successfully!');

            } else {
                session()->flash('error', 'Cannot Edit !');
                return redirect()->route('sivr-page-elements.edit', ['sivr_page_element' => $sivrPageElement])->withInput()->withErrors($result->validator ?? $result->errors);
            }
            return redirect(route('sivr-page-elements.show', ['sivr_page_element' => session('sivrPage')]));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(SivrPageElement $sivrPageElement)
    {
        if (Auth::check()) {
            $result = $this->sivrPageElementService->deleteItem($sivrPageElement);
            if ($result->status == 209) {

                session()->flash('success', 'Record ' . $result->messages . ' successfully!');

            } else {

                session()->flash('error', 'Can not Delete !');
            }
            return redirect(route('sivr-page-elements.show', ['sivr_page_element' => session('sivrPage')]));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function uploadMenuIcon(SivrPageElement $pageElement)
    {
        return view('sivr.pageElements.menuIconUpload', compact('pageElement'));
    }

    public function storeMenuIcon(Request $request)
    {
        if (Auth::check()) {
        $result = $this->sivrPageElementService->storeMenuIcon($request);
        if ($result->status == 201) {
            session()->flash('success', 'Menu icon uploaded successfully!');
        } else {
            session()->flash('error', 'Can not upload menu icon!');
            return redirect()->back()->withErrors($result->validator ?? $result->messages)->withInput();

        }

        return redirect()->back();
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

}
