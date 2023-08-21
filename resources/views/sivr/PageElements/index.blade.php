@extends('layout.app')
@section('content')
    @php
        $pageElements=$sivrPage->pageElements;
        $children=$sivrPage->children;

        session(['sivrPage'=>$sivrPage])@endphp

    <script >
        let children ={!! $children->toJson() !!};
        console.log(children);
    </script>

    <main class="g-page-wrap">

        <div class="g-page-content-area mt-2 mt-md-4">

            <div class="g-page-content-main">
                <!--**********************************
                                 Showings  page Elements
                         ***********************************-->

                <div class="container-fluid px-5 ">
                    <div class="text-end mb-3">
                        <button class="btn btn-outline-primary btn-sm d-inline-flex align-items-center gap-1"
                        ><a href="{{route('sivr-page-elements.create')}}"><i class="bi bi-plus"></i> Add
                                New Page Element</a>
                        </button>
                    </div>
                    @if(count($pageElements)>0)
                        {{--                start--}}
                        @foreach($pageElements as $pageElement)

                            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="element-tab" data-bs-toggle="tab"
                                            data-bs-target="#element-tab-pane-{{$pageElement->id}}" type="button"
                                            role="tab"
                                            aria-controls="element-tab-pane-{{$pageElement->id}}" aria-selected="true">
                                        <i class="ph-fill ph-stack"></i>
                                        Element Info
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route("sivr-page-elements.edit",['sivr_page_element' => $pageElement])}}">
                                        <button
                                            class="btn nav-link  d-inline-flex align-items-center gap-1"><i
                                                class="ph-fill ph-pencil-simple-line"></i> Edit
                                        </button>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="{{url("/page-elements/upload-menu-icon",['pageElement' => $pageElement])}}"> <button class="nav-link"
                                    >
                                        <i
                                            class="ph-fill ph-upload"></i> Upload Menu Icon
                                        </button></a>
                                </li>


                                <li class="nav-item" role="presentation">
                                    <button class="nav-link delete-page-element-btn"
                                            data-page-element-id="{{$pageElement->id}}" type="button"

                                            aria-selected="false">
                                        <i
                                            class="ph-fill ph-trash-simple"></i> Delete
                                    </button>
                                </li>
                            </ul>


                            <div class="tab-content " id="nodeTabContent">

                                <div class="tab-pane fade show active" id="element-tab-pane-{{$pageElement->id}}"
                                     role="tabpanel"
                                     aria-labelledby="element-tab" tabindex="0">
                                    <div class="table-responsive ">
                                        <table
                                            class="table table-bordered table-striped table-sm border-secondary page-elements">
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

                                <div class="tab-pane fade" id="upload-tab-pane-{{$pageElement->id}}" role="tabpanel"
                                     aria-labelledby="upload-tab"
                                     tabindex="0">Upload
                                </div>

                            </div>
                        @endforeach
                        {{--                end--}}
                    @endif
                </div>
            </div>
        </div>
        <!--**********************************
                           Delete page element Alert
                    ***********************************-->
        <div id="delete-page-element-toast"
             class="toast bg-white d-flex align-items-center justify-content-center position-fixed d-none"
             aria-live="assertive" aria-atomic="true" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">

            <div class="toast-body">
                <h6>Are you sure you want to delete the node?</h6>
                <div class="pt-2 border-top">
                    <form id="delete-page-element-form"
                          action="{{ route('sivr-page-elements.destroy', ['sivr_page_element' => ':pageElementId']) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button id="page-delete-confirm" type="submit" class="btn btn-primary btn-sm text-white">Confirm
                        </button>
                        <button id="page-delete-cancel" type="button" class="btn btn-secondary btn-sm"
                                data-bs-dismiss="toast">Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </main>
    <script src="{{asset('assets/js/page-element-index.js')}}"></script>
@endsection
