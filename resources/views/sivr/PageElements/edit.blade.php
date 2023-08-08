@extends('layout.app')


@section('content')
    <script>
        let pageElement = {!!   $sivr_page_element->toJson() !!};
        let compareApis={!!$sivr_page_element->compareApis?$sivr_page_element->compareApis->toJson():null!!};
console.log(compareApis);

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
                                                <h5 class="text-white mb-0">Page element edit Form</h5>

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

                                                <form
                                                    action="{{ route('sivr-page-elements.update',['sivr_page_element' => $sivr_page_element]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">


                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit-element-order">Element Order</label>
                                                            <input class="form-control " type="number"
                                                                   name="element_order"
                                                                   id="edit-element-order"
                                                                   value="{{old('element_order',$sivr_page_element->element_order)}}" min="1">
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit-element-text-en">Text (EN)</label>
                                                            <input class="form-control " type="text"
                                                                   name="display_name_en"
                                                                   id="edit-element-text-en"
                                                                   value="{{old('display_name_en',$sivr_page_element->display_name_en)}}">
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit-element-text-bn">Text (BN)</label>
                                                            <input class="form-control " type="text"
                                                                   name="display_name_bn"
                                                                   id="edit-element-text-bn"
                                                                   value="{{old('display_name_bn',$sivr_page_element->display_name_bn)}}">
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">

                                                            <label for="edit-element-color">Text Color</label>
                                                            <input class="form-control " type="color" name="text_color"
                                                                   id="edit-element-color"
                                                                   value="{{old('text_color',$sivr_page_element->text_color)}}">
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit-element-bg-color">Background Color</label>
                                                            <input class="form-control " type="color"
                                                                   name="background_color"
                                                                   id="edit-element-bg-color"
                                                                   value="{{old('background_color',$sivr_page_element->background_color)}}">
                                                        </div>
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="name">Element Name:</label>
                                                            <input class="form-control" type="text"
                                                                   name="name"
                                                                   id="name"
                                                                   value="{{old('name',$sivr_page_element->name)}}">
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit-element-no-rows">No Of Rows</label>
                                                            <input class="form-control " type="number" name="rows"
                                                                   id="edit-element-no-rows"
                                                                   value="{{old('rows',$sivr_page_element->rows)}}">
                                                        </div>
                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit-element-no-columns">No Of Columns</label>
                                                            <input class="form-control form-control-sm" type="number"
                                                                   name="columns"
                                                                   id="edit-element-no-columns"
                                                                   value="{{old('columns',$sivr_page_element->columns)}}">
                                                        </div>


                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit-element-visibility">Element
                                                                Visibility</label>
                                                            <select name="is_visible" id="edit-element-visibility"
                                                                    class="form-control">
                                                                <option
                                                                    value="Y" {{old('is_visible',$sivr_page_element->is_visible)=='Y'?'selected':''}}>
                                                                    Visible
                                                                </option>
                                                                <option
                                                                    value="N" {{old('is_visible',$sivr_page_element->is_visible)=='N'?'selected':''}}>
                                                                    Invisible
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="edit-element-provider-function">Data Provider
                                                                Function</label>
                                                            <input class="form-control" type="text"
                                                                   name="data_provider_function"
                                                                   id="edit-element-provider-function"
                                                                   value="{{old('data_provider_function',$sivr_page_element->data_provider_function)}}">
                                                        </div>

                                                        <div class="form-group col-md-4 mb-3">
                                                            <label for="g-element-type">Element Type</label>
                                                            <select name="type" id="g-element-type"
                                                                    class="form-control">
                                                                <option
                                                                    value="button" {{ old('type',$sivr_page_element->type) == 'button' ? 'selected' : '' }}>
                                                                    Button
                                                                </option>
                                                                <option
                                                                    value="paragraph" {{ old('type',$sivr_page_element->type) == 'paragraph' ? 'selected' : '' }}>
                                                                    Paragraph
                                                                </option>
                                                                <option
                                                                    value="hyperlink" {{ old('type',$sivr_page_element->type) == 'hyperlink' ? 'selected' : '' }}>
                                                                    Hyperlink
                                                                </option>

                                                                <option
                                                                    value="table"{{ old('type',$sivr_page_element->type) == 'table' ? 'selected' : '' }}>
                                                                    Table
                                                                </option>
                                                                <option
                                                                    value="input"{{ old('type',$sivr_page_element->type) == 'input' ? 'selected' : '' }}>
                                                                    Input
                                                                </option>
                                                                <option
                                                                    value="compare_api"{{ old('type',$sivr_page_element->type) == 'compare_api' ? 'selected' : '' }}>
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
                                                            <button class="btn btn-primary w-100" type="submit">UPDATE
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


    <script type="module" src="{{asset('assets/js/page-element.js')}}"></script>
@endsection
