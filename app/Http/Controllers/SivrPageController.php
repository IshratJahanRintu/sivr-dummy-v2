<?php

namespace App\Http\Controllers;

use App\Models\SivrPage;
use App\Models\Vivr;
use App\Services\SivrPageService;
use App\Services\VivrService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SivrPageController extends Controller
{
   protected $sivrPageService;
    protected $vivrService;

    function __construct()
    {
        $this->sivrPageService = new SivrPageService();
        $this->vivrService=new VivrService();
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
//    function index()
//    {
//        if(Auth::check()) {
//            $result = $this->sivrPageService->listItems();
//
//            if ($result->status == 200) {
//                $data = $result->data;
//                $sivrPages = $data[0];
//                $allPages = $data[1];
//
//                return view('sivr.sivrPages.index', compact('sivrPages', 'allPages'));
//
//            }
//        }
//        return redirect("login")->withSuccess('Opps! You do not have access');
//    }


    public function show($vivrId)
    {
        session(['vivrId'=>$vivrId]);
        $result = $this->sivrPageService->listItems($vivrId);

        if ($result->status == 200) {
            $allPages=$result->data;
            $rootPage=$allPages->where('parent_page_id', null);


            return view('sivr.sivrPages.index', compact('rootPage', 'allPages'));

        }
    }

    public function create(SivrPage $sivrPage = null)
    {
        $vivrId=session('vivrId');
        if(Auth::check()) {
            $result= $this->sivrPageService->listItems($vivrId);

            if ($result->status == 200 ) {

                $sivrPages = $result->data;


                return view('sivr.sivrPages.create', compact('sivrPage','sivrPages'));
            }
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function store(Request $request)
    {
        $vivrId=session('vivrId');
        if(Auth::check()) {

            $result = $this->sivrPageService->createItem($request);
            if ($result->status == 201) {
                session()->flash('success', 'Record ' . $result->messages . ' successfully!');
            } else {
                session()->flash('error', 'Can not Create !');
                return redirect()->route('sivr-pages.create')->withInput()->withErrors($result->validator ?? '');

            }

            return redirect( route('sivr-pages.show',['sivr_page'=>$vivrId]));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function uploadAudio(SivrPage $sivrPage = null)
    {
        $vivrId=session('vivrId');
        if(Auth::check()) {
        $allPages = null;
        $result = $this->sivrPageService->listItems($vivrId);

        if ($result->status == 200) {

            $allPages = $result->data;
        }
        else{
            dd('No data found');
        }
        return view('sivr.sivrPages.audioUpload', ['sivrPage'=>$sivrPage,'allPages'=>$allPages]);
        }
        return redirect("login")->withSuccess('Opps! You do not have access');

    }

    public function saveAudio(Request $request)
    {
        if(Auth::check()) {
        $result=$this->sivrPageService->storeAudio($request);
        if ($result->status == 201) {
            session()->flash('success', 'Audio uploaded successfully!');
        } else {
            session()->flash('error', 'Can not Upload Audio!');
            return redirect()->back()->withErrors($result->validator ?? $result->messages)->withInput();

        }

        return redirect()->back();
        }
        return redirect("login")->withSuccess('Opps! You do not have access');

    }




    /**
     * Show the form for editing the specified resource.
     *
     *
     */
    public function edit(SivrPage $sivrPage)
    {
        if(Auth::check()) {

            return view('sivr.sivrPages.edit', compact('sivrPage'));
        }

        return redirect("login")->withSuccess('Opps! You do not have access');

    }


    public
    function update(Request $request, SivrPage $sivrPage)
    {
        if(Auth::check()) {
            $vivrId=session('vivrId');
        $result = $this->sivrPageService->updateItem($request, $sivrPage);

        if ($result->status == 208) {
            session()->flash('success', 'Sivr Page ' . $result->messages . ' successfully!');
            return redirect( route('sivr-pages.show',['sivr_page'=>$vivrId]));
        } else {
            session()->flash('error', 'Cannot Edit !');
            return redirect()->route('sivr-pages.edit', $sivrPage)->withInput()->withErrors($result->validator ?? $result->messages);
        }
        }
        return redirect("login")->withSuccess('Opps! You do not have access');


    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public
    function destroy(SivrPage $sivrPage)
    {
        if(Auth::check()) {
            $vivrId=session('vivrId');
        $result = $this->sivrPageService->deleteItem($sivrPage);

        if ($result->status == 209) {

            session()->flash('success', 'Record ' . $result->messages . ' successfully!');

        } else {

            session()->flash('error', 'Can not Delete !');
        }
            return redirect( route('sivr-pages.show',['sivr_page'=>$vivrId]));
        }
        return redirect("login")->withSuccess('Opps! You do not have access');

    }


    public function deleteAudio(Request $request,SivrPage $sivrPage){
        if(Auth::check()) {
        $result=$this->sivrPageService->deleteAudio($request,$sivrPage);
        if ($result->status == 209) {

            session()->flash('success', 'Record ' . $result->messages . ' successfully!');

        } else {

            session()->flash('error', 'Can not Delete Audio !');
        }

        return redirect()->back();

    }

return redirect("login")->withSuccess('Opps! You do not have access');


}
}

