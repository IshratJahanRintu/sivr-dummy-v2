@extends('layout.app')


@section('content')
    <main class="g-page-wrap">

        <div class="g-page-content-area mt-2 mt-md-4">

            <div class="g-page-content-main">

                <!--**********************************
                           Account Create Form
                 ***********************************-->
                <div class="g-create-form-area">
                    <div class="container-fluid">
                        <div class="g-create-form-main">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header bg-secondary">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="text-white mb-0">{{ $title ?? '' }} Create Form</h5>
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
                                                <form action="{{route("sivr-pages.store")}}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="add-parent-page-id">Parent Page</label>
                                                            <select class="form-control" name="parent_page_id" id="add-parent-page-id">
                                                                @foreach($sivrPages as $sivrPage)
                                                                    <option value={{$sivrPage->id}}>{{$sivrPage->page_heading_en}}</option>

                                                                @endforeach

                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="service_title_id">Service Title ID</label>
                                                            <select class="form-control" name="service_title_id" id="service_title_id">

                                                                <option value="123" {{ old('service_title_id') == '123' ? 'selected' : '' }}>123</option>
                                                                <option value="456" {{ old('service_title_id') == '456' ? 'selected' : '' }}>456</option>
                                                                <option value="789" {{ old('service_title_id') == '789' ? 'selected' : '' }}>789</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="vivr_id">VIVR ID</label>
                                                            <select class="form-control" name="vivr_id" id="vivr_id">
                                                                <option value="123" {{ old('vivr_id') == '123' ? 'selected' : '' }}>123</option>
                                                                <option value="456" {{ old('vivr_id') == '456' ? 'selected' : '' }}>456</option>
                                                                <option value="789" {{ old('vivr_id') == '789' ? 'selected' : '' }}>789</option>
                                                                <option value="12212" {{ old('vivr_id') == '12212' ? 'selected' : '' }}>12212</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="task">Task</label>
                                                            <select class="form-control" name="task" id="task">
                                                                <option value="navigation" {{ old('task') == 'navigation' ? 'selected' : '' }}>Navigation</option>
                                                                <option value="compare" {{ old('task') == 'compare' ? 'selected' : '' }}>Compare</option>
                                                                <option value="others" {{ old('task') == 'others' ? 'selected' : '' }}>Others</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="page_heading_en">Page Heading (EN)</label>
                                                            <input type="text" class="form-control" name="page_heading_en" id="page_heading_en"
                                                                   placeholder="Page Heading (EN)" value="{{ old('page_heading_en') }}">
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="page_heading_ban">Page Heading (BN)</label>
                                                            <input type="text" class="form-control" name="page_heading_ban" id="page_heading_ban"
                                                                   placeholder="Page Heading (BN)" value="{{ old('page_heading_ban') }}">
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="has_main_menu">Navigate To Main Page</label>
                                                            <select class="form-control" name="has_main_menu" id="has_main_menu">
                                                                <option value="Y" {{ old('has_main_menu') == 'Y' ? 'selected' : '' }}>YES</option>
                                                                <option value="N" {{ old('has_main_menu') == 'N' ? 'selected' : '' }}>NO</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="has_previous_menu">Navigate To Previous Page</label>
                                                            <select class="form-control" name="has_previous_menu" id="has_previous_menu">
                                                                <option value="Y" {{ old('has_previous_menu') == 'Y' ? 'selected' : '' }}>YES</option>
                                                                <option value="N" {{ old('has_previous_menu') == 'N' ? 'selected' : '' }}>NO</option>
                                                            </select>
                                                        </div>


                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4 mx-auto mt-4">
                                                            <button class="btn btn-primary w-100" type="submit">SAVE
                                                            </button>
                                                        </div>
                                                    </div>
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

                <!--                End Create Form-->


            </div>
        </div>

    </main>
@endsection
