@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layout.app')


@section('content')
    @if(isset($pageElement))
        @php
            if ($pageElement->menu_icon!=null){

                $uploadedIconUrl=asset('storage/'.$pageElement->menu_icon);
            }
        @endphp

        <main class="g-page-wrap">

            <div class="g-page-content-area mt-2 mt-md-4">

                <div class="g-page-content-main">

                    <!--**********************************
                            EDIT SIVR PAGE FORM
                     ***********************************-->
                    <div class="g-create-form-area">
                        <div class="container-fluid">
                            <div class="g-create-form-main">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header bg-secondary">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="text-white mb-0">Menu Icon Upload Form </h5>

                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div class="g-create-form">
                                                    <!--Start Form-->
                                                    <div class="menu-icon-container">
                                                        <h5>Menu icon </h5>

                                                        <div class="icon-preview">
                                                            <div
                                                                class="icon-image-container {{ isset($uploadedIconUrl) ? '' : 'icon-label-empty' }}"
                                                                @if(isset($uploadedIconUrl)) style="background-image: url('{{ $uploadedIconUrl }}');" @endif>
                                                            </div>
                                                            <span class="icon-label">Previous Icon</span>

                                                        </div>
                                                        <form class=" mb-3 w-100" id="audioForm" method="POST"
                                                              action="{{url('/page-elements/store-menu-icon')}}"
                                                              enctype="multipart/form-data"
                                                              multiple>
                                                            @csrf
                                                            <input type="hidden" name="page_element_id"
                                                                   value="{{$pageElement->id}}">
                                                            <label class="menu-icon-label" for="menu_icon">Upload Menu
                                                                Icon</label>
                                                            <input class="form-control upload-icon-btn" type="file"
                                                                   accept="image/*"
                                                                   name="menu_icon"
                                                                   id="menu_icon"/>
                                                            <button class="btn btn-success btn-sm mb-3 mt-3"
                                                                    type="submit">
                                                                Upload
                                                            </button>
                                                        </form>
                                                        <!--End Form-->

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


        </main>
    @endif

@endsection

