@extends('layout.app')


@section('content')
    <script>
    $(document).ready(function() {
    $('.vivr-list').select2();
    });
    </script>
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
                                                <h5 class="text-white mb-0"> Edit Form</h5>

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

                                                <form action="{{ route('sivr-pages.update', $sivrPage) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit_service_title_id">Service Title ID</label>
                                                            <select class="form-control form-control-sm" name="service_title_id" id="edit_service_title_id">
                                                                <option value="123" {{ old('service_title_id', $sivrPage->service_title_id) == '123' ? 'selected' : '' }}>123</option>
                                                                <option value="456" {{ old('service_title_id', $sivrPage->service_title_id) == '456' ? 'selected' : '' }}>456</option>
                                                                <option value="789" {{ old('service_title_id', $sivrPage->service_title_id) == '789' ? 'selected' : '' }}>789</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="vivr-id">VIVR ID</label>
                                                            <select class="vivr-list form-control" name="vivr_id" id="vivr-id">
                                                                @foreach($vivrList as $vivr)
                                                                    <option value={{$vivr->id}} {{ old('vivr_id',$sivrPage->vivr_id) == $vivr->id ? 'selected' : '' }}>{{$vivr->title}}</option>

                                                                @endforeach

                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit_task">Task</label>
                                                            <select class="form-control form-control-sm" name="task" id="edit_task">
                                                                <option value="navigation" {{ old('task', $sivrPage->task) == 'navigation' ? 'selected' : '' }}>Navigation</option>
                                                                <option value="compare" {{ old('task', $sivrPage->task) == 'compare' ? 'selected' : '' }}>Compare</option>
                                                                <option value="others" {{ old('task', $sivrPage->task) == 'others' ? 'selected' : '' }}>Others</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit_page_heading_en">Page Heading (EN)</label>
                                                            <input type="text" class="form-control form-control-sm" name="page_heading_en" id="edit_page_heading_en" placeholder="Page Heading (EN)" value="{{ old('page_heading_en', $sivrPage->page_heading_en) }}">
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit_page_heading_ban">Page Heading (BN)</label>
                                                            <input type="text" class="form-control form-control-sm" name="page_heading_ban" id="edit_page_heading_ban" placeholder="Page Heading (BN)" value="{{ old('page_heading_ban', $sivrPage->page_heading_ban) }}">
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit_has_main_menu">Navigate To Main Page</label>
                                                            <select class="form-control form-control-sm" name="has_main_menu" id="edit_has_main_menu">
                                                                <option value="Y" {{ old('has_main_menu', $sivrPage->has_main_menu) == 'Y' ? 'selected' : '' }}>YES</option>
                                                                <option value="N" {{ old('has_main_menu', $sivrPage->has_main_menu) == 'N' ? 'selected' : '' }}>NO</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit_has_previous_menu">Navigate To Previous Page</label>
                                                            <select class="form-control form-control-sm" name="has_previous_menu" id="edit_has_previous_menu">
                                                                <option value="Y" {{ old('has_previous_menu', $sivrPage->has_previous_menu) == 'Y' ? 'selected' : '' }}>YES</option>
                                                                <option value="N" {{ old('has_previous_menu', $sivrPage->has_previous_menu) == 'N' ? 'selected' : '' }}>NO</option>
                                                            </select>
                                                        </div>

                                                        <!-- Add similar code for other input fields -->

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4 mx-auto mt-4">
                                                            <button class="btn btn-primary w-100" type="submit">UPDATE</button>
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
