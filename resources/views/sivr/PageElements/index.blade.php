@extends('layout.app')
@section('content')
@php
    $pageElements=$sivrPage->pageElements;
    session(['sivrPage'=>$sivrPage])@endphp



    <main class="g-page-wrap">

        <div class="g-page-content-area mt-2 mt-md-4">

            <div class="g-page-content-main">
<!--**********************************
                 Modal For page Element
         ***********************************-->

            <div class="container-fluid px-5 ">
                <div class="text-end mb-3">
                    <button class="btn btn-outline-primary btn-sm d-inline-flex align-items-center gap-1"
                            ><a   href="{{route('sivr-page-elements.create')}}"><i class="bi bi-plus"></i> Add
                        New Page Element</a>
                    </button>
                </div>
                @if(count($pageElements)>0)
{{--                start--}}
                @foreach($pageElements as $pageElement)

                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="element-tab" data-bs-toggle="tab"
                                data-bs-target="#element-tab-pane-{{$pageElement->id}}" type="button" role="tab"
                                aria-controls="element-tab-pane-{{$pageElement->id}}" aria-selected="true"><i class="ph-fill ph-stack"></i>
                            Element Info
                        </button>
                    </li>
                    <li class="nav-item">
                        <button onclick="populateEditElementForm('${pageElementJson}')"
                                class="btn nav-link  d-inline-flex align-items-center gap-1" id="edit-element-button"
                                data-bs-toggle="modal" data-bs-target="#edit-page-element-modal"><i
                                class="ph-fill ph-pencil-simple-line"></i> Edit
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#upload-tab-pane-{{$pageElement->id}}"
                                type="button" role="tab" aria-controls="upload-tab-pane-{{$pageElement->id}}" aria-selected="false"><i
                                class="ph-fill ph-upload"></i> Upload Menu Icon
                        </button>
                    </li>


                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="disabled-tab" data-bs-toggle="tab"
                                data-bs-target="#delete-tab-pane-{{$pageElement->id}}" type="button" role="tab"
                                aria-controls="delete-tab-pane-{{$pageElement->id}}" aria-selected="false"><i
                                class="ph-fill ph-trash-simple"></i> Delete
                        </button>
                    </li>
                </ul>


                <div class="tab-content " id="nodeTabContent">

                    <div class="tab-pane fade show active" id="element-tab-pane-{{$pageElement->id}}" role="tabpanel"
                         aria-labelledby="element-tab" tabindex="0">
                        <div class="table-responsive ">
                            <table class="table table-bordered table-striped table-sm border-secondary page-elements">
                                <tbody>
                                <tr>
                                    <td>Element Type:</td>
                                    <td>{{$pageElement->type}}</td>
                                </tr>
                                <tr>
                                    <td>Element Order</td>
                                    <td>{{$pageElement->element_order}}</td>
                                </tr>
                                <tr>
                                    <td>Text (EN) :</td>
                                    <td>{{$pageElement->display_name_en}}</td>
                                </tr>
                                <tr>
                                    <td>Text (BN) :</td>
                                    <td>{{$pageElement->display_name_bn}}</td>
                                </tr>
                                <tr>
                                    <td>Text Color :</td>
                                    <td>{{$pageElement->text_color}}</td>
                                </tr>
                                <tr>
                                    <td>Background Color :</td>
                                    <td>{{$pageElement->background_color}}</td>
                                </tr>
                                <tr>
                                    <td>Element Name :</td>
                                    <td>{{$pageElement->name}}</td>
                                </tr>
                                <tr>
                                    <td>Element Value :</td>
                                    <td>{{$pageElement->value}}</td>
                                </tr>
                                <tr>
                                    <td>No Of Rows :</td>
                                    <td>{{$pageElement->rows}}</td>
                                </tr>
                                <tr>
                                    <td>No Of Columns :</td>
                                    <td>{{$pageElement->columns}}</td>
                                </tr>
                                <tr>
                                    <td>Element Visibility :</td>
                                    <td>{{($pageElement->is_visible === 'Y') ? 'Visible' : 'Not Visible'}}</td>
                                </tr>
                                <tr>
                                    <td>Data Provider Function :</td>
                                    <td>{{$pageElement->data_provider_function}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="upload-tab-pane-{{$pageElement->id}}" role="tabpanel" aria-labelledby="upload-tab"
                         tabindex="0">Upload
                    </div>
                    <div class="tab-pane fade" id="delete-tab-pane-{{$pageElement->id}}" role="tabpanel" aria-labelledby="delete-tab"
                         tabindex="0">Edit
                    </div>
                </div>
                @endforeach
{{--                end--}}
                @endif
            </div>
        </div>
    </div>



    </main>

@endsection
