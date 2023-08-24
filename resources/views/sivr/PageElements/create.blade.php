@extends('layout.app')


@section('content')
    @php
    $allPages=session('sivrPages');
    $sivrPage=session('sivrPage');

    @endphp
    <script>
        let sivrPage = {!!   $sivrPage->toJson() !!};
        let allPages={!! $allPages !!};

console.log(allPages);
    </script>

    <main class="g-page-wrap">

        <div class="g-page-content-area mt-2 mt-md-4">

            <div class="g-page-content-main">

                <!--**********************************
                           Page element create form
                 ***********************************-->
                <div class="g-create-form-area">
                    <div class="container-fluid">
                        <div class="g-create-form-main">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header bg-secondary">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="text-white mb-0">{{ $title ?? '' }} Create New Page
                                                    Element</h5>
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

                                                <form action="{{route("sivr-page-elements.store")}}" method="POST">
                                                    @csrf
                                                    <div class="row">

                                                        <input type="hidden" name="page_id"
                                                               id="page_element_add_page_id" value="{{$sivrPage->id}}">


                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-order">Element Order</label>
                                                            <input class="form-control" type="number"
                                                                   name="element_order" id="g-element-order"
                                                                   value="{{old('element_order',1)}}" min="1" >
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-text-en">Display Text (EN)</label>
                                                            <input class="form-control" type="text"
                                                                   name="display_name_en"
                                                                   id="g-element-text-en"
                                                                   value="{{old('display_name_en')}}">
                                                        </div>
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-text-bn">Display Text (BN)</label>
                                                            <input class="form-control" type="text"
                                                                   name="display_name_bn"
                                                                   id="g-element-text-bn"
                                                                   value="{{old('display_name_bn')}}">
                                                        </div>


                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-color">Text Color</label>
                                                            <input class="form-control" type="color"
                                                                   name="text_color" id="g-element-color"
                                                                   value="{{old('text_color')}}">
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-bg-color">Background Color</label>
                                                            <input class="form-control" type="color"
                                                                   name="background_color"
                                                                   id="g-element-bg-color"
                                                                   value="{{old('background_color')}}">
                                                        </div>



                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-visibility">Element Visibility</label>
                                                            <select name="is_visible" id="g-element-visibility"
                                                                    class="form-control">
                                                                <option
                                                                    value="Y" {{ old('is_visible') == 'Y' ? 'selected' : '' }}>
                                                                    Visible
                                                                </option>
                                                                <option
                                                                    value="N" {{ old('is_visible') == 'N' ? 'selected' : '' }}>
                                                                    Invisible
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-provider-function">Data Provider
                                                                Function</label>
                                                            <input class="form-control" type="text"
                                                                   name="data_provider_function"
                                                                   id="g-element-provider-function"
                                                                   value="{{old('data_provider_function')}}">
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-type">Element Type</label>
                                                            <select name="type" id="g-element-type"
                                                                    class="form-control">
                                                                <option
                                                                    value="button" >
                                                                    Button
                                                                </option>
                                                                <option
                                                                    value="paragraph" >
                                                                    Paragraph
                                                                </option>
                                                                <option
                                                                    value="link" >
                                                                    External link
                                                                </option>

                                                                <option
                                                                    value="table">
                                                                    Table
                                                                </option>
                                                                <option
                                                                    value="input">
                                                                    Input
                                                                </option>
                                                                <option
                                                                    value="compare_api">
                                                                    Compare Api
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="g-create-form">
                                                            <div id="element-wise-value" class="row">

                                                            </div>
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
    <script  src="{{asset('assets/js/page-elements/Button.js')}}"></script>
    <script  src="{{asset('assets/js/page-elements/CompareApi.js')}}"></script>
    <script  src="{{asset('assets/js/page-elements/Table.js')}}"></script>
    <script  src="{{asset('assets/js/page-elements/Input.js')}}"></script>
    <script  src="{{asset('assets/js/page-elements/Paragraph.js')}}"></script>
    <script  src="{{asset('assets/js/page-elements/Link.js')}}"></script>
    <script  src="{{asset('assets/js/page-element.js')}}"></script>


@endsection
