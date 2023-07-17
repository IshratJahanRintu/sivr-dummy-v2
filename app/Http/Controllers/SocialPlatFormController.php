<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Services\SocialPlatformService;

use App\Models\SocialPlatform;
use Auth;

class SocialPlatformController extends Controller
{

    private $SocialPlatformService;

    public function __construct()
    {
        // $this->SocialPlatformService    = new SocialPlatFormService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::check()) {

            $data = new \stdClass;
            if(Auth::user()->can('social-platform-list')) {

                /* if(isset($request->perPage) && $request->perPage <= 150){
                    session(['perPage' => $request->perPage]);
                }

                $request->perPage = session()->has('perPage') ? session('perPage') : config('others.ROW_PER_PAGE');
                $result = $this->SocialPlatformService->listItems($request);

                if( $result->status == 200 ){
                    $data->data             = $result->data;
                    $data->perPage          = $request->perPage;
                    $data->routeLink        = 'social-platform.create';
                    $data->updateRouteLink  = 'social-platform.edit';
                    $data->headerLink       = 'social-platform.index';
                } */
                $data->headerLink       = 'social-platform.index';
                $data->data             = config('others.SOCIAL_PLATFORM');
                return view('social-platform.list')->with(['dataPack'=>$data])->withTitle('Social Platform');

            }

            return $this->noPermissionResponse();
        }

        return redirect("login")->withSuccess('Opps! You need to log in first!!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* if(Auth::check()) {

            $data = new \stdClass;

            if(Auth::user()->can('social-platform-create')) {

                $data->clientList   = $this->clientService->listItems();
                $data->mediaType    = config('others.SOCIAL_MEDIA');
                $data->routeLink    = 'social-platform.create';
                $data->headerLink   = 'social-platform.index';
                $data->apiToken     = bin2hex(random_bytes(32));

                return view('social-platform.create')->with(['dataPack' => $data])->withTitle('Social Platform');

            }

            return $this->noPermissionResponse();

        }

        return redirect("login")->withSuccess('Opps! You need to log in first!!'); */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /* if(Auth::check()) {

            if(Auth::user()->can('social-platform-store')) {

                $result = $this->SocialPlatformService->createItem($request);

                if($result->status == 201){
                    session()->flash('success', 'Record '. $result->messages. ' successfully!');
                }else{
                    session()->flash('error', 'Can not Create !');
                }

                return redirect()->route('social-platform.index');

            }

            return $this->noPermissionResponse();
        }

        return redirect("login")->withSuccess('Opps! You need to log in first!!'); */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function getPageId($id)
    {

        /* return $this->SocialPlatformService->getPageItem($id); */

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* if(Auth::check()) {

            $data = new \stdClass;

            if(Auth::user()->can('social-platform-edit')) {

                $result                     = $this->SocialPlatformService->showItem($id);
                $data->SocialPlatformInfo      = $result->data ? $result->data : "";
                $data->clientList           = $this->clientService->listItems();
                $data->mediaType            = config('others.SOCIAL_MEDIA');
                $data->routeLink            = 'social-platform.create';
                $data->headerLink           = 'social-platform.index';
                $data->apiToken             = bin2hex(random_bytes(32));

                return view('social-platform.edit')->with(['dataPack' => $data])->withTitle('Social Platform');

            }

            return $this->noPermissionResponse();

        }

        return redirect("login")->withSuccess('Opps! You need to log in first!!'); */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /* if(Auth::check()) {

            $data = new \stdClass;

            // dd($request);

            if(Auth::user()->can('social-platform-update')) {

                $result = $this->SocialPlatformService->updateItem($request, $id);

                if($result->status == 208){
                    session()->flash('success', 'Record '. $result->messages. ' successfully!');
                }else{
                    session()->flash('error', 'Can not Update!');
                }

                return redirect()->route('social-platform.index');

            }

            return $this->noPermissionResponse();
        }


        return redirect("login")->withSuccess('Opps! You need to log in first!!'); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        /* if(Auth::check()) {

            if(Auth::user()->can('social-platform-delete') && SocialPlatform::where('id', $id)->first()) {

                $result = $this->SocialPlatformService->deleteItem($id);

                if($result->status == 209){
                    session()->flash('success', 'Record '. $result->messages. ' successfully!');
                }else{
                    session()->flash('error', 'Can not Delete !');
                }

                return redirect()->route('social-platform.index');

            }

            return $this->noPermissionResponse();

        }

        return redirect("login")->withSuccess('Opps! You need to log in first!!'); */

    }
}
