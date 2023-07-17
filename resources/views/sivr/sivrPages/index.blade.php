@extends('layout.app')
@section('content')
    <script>
        let sivrPagesJson = {!!   $sivrPagesJson !!};
    </script>
    <div class="g-page-content-area">

        <div class="g-page-content-main">


            <!--**********************************
                          SIVR TREE MENU
             ***********************************-->
            <div class="container-fluid mb-3">
                <div class="g-sivr-tree-area">
                    <div class="g-sivr-tree-main">
                        <div class="card">
                            <div class="card-body">
                                <div class="g-tree-view-area">
                                    <h3 class="heading">SIVR Tree Menu</h3>
                                    <!--**********************************
                                  Right Context Menu
                       ***********************************-->
                                    <div id="navMenu" class="nav-menu">
                                        <ul class="nav-list-group">
                                            <li id="edit-option" class="" data-bs-toggle="modal"
                                                data-bs-target="#g-sivr-edit-modal"><i class="ph-fill ph-pencil-simple"></i>
                                                Edit
                                            </li>
                                            <li id="add-option" class="" data-bs-target="#g-sivr-add-modal" data-bs-toggle="modal">
                                                <i class="ph-fill ph-plus"></i> Add Branch
                                            </li>
                                            <li id="audio-upload-option" class="" data-bs-target="#g-sivr-audio-upload-modal"
                                                data-bs-toggle="modal"><i
                                                    class="ph-fill ph-upload"></i> Upload
                                                File
                                            </li>
                                            <li class="" data-bs-toggle="modal" id="node-element-option"
                                                data-bs-target="#node-element-modal"><i class="ph-fill ph-circles-three-plus"></i>
                                                Node Element
                                            </li>
                                            <li class="" id="jsDeleteTreeConfirm"><i class="ph-fill ph-trash-simple"></i>
                                                Delete Tree
                                            </li>
                                        </ul>
                                    </div>
                                    <!--End Right Context Menu-->
                                    <div class="file-browser">


                                        <ul>
                                            @if(($sivrPages->count() == 0))
                                                <button id="add-child-button">Add Child</button>
                                            @else
                                                @foreach ($sivrPages as $sivrPage)
                                                    <li class="{{$sivrPage->hasChildren()?'folder':'file'}} "><span
                                                            data-sivrpage-id={{$sivrPage->id}} class="node-name">{{$sivrPage->page_heading_en}}</span>

                                                        @include('sivr.sivrPages.children', ['children' => $sivrPage->children])
                                                    </li>
                                                @endforeach

                                        </ul>
                                        @endif

                                    </div>
                                </div>
                            </div>


                        </div>


                        <!--**********************************
                                    Right Context Menu
                         ***********************************-->
                        <div id="contextMenu" class="context-menu">
                            <ul class="list-group">
                                <li id="edit-option" class="" data-bs-toggle="modal"
                                    data-bs-target="#g-sivr-edit-modal"><i class="ph-fill ph-pencil-simple"></i>
                                    Edit
                                </li>
                                <li id="add-option" class="" data-bs-target="#g-sivr-add-modal" data-bs-toggle="modal">
                                    <i class="ph-fill ph-plus"></i> Add Branch
                                </li>
                                <li id="audio-upload-option" class="" data-bs-target="#g-sivr-audio-upload-modal"
                                    data-bs-toggle="modal"><i
                                        class="ph-fill ph-upload"></i> Upload
                                    File
                                </li>
                                <li class="" data-bs-toggle="modal" id="node-element-option"
                                    data-bs-target="#node-element-modal"><i class="ph-fill ph-circles-three-plus"></i>
                                    Node Element
                                </li>
                                <li class="" id="jsDeleteTreeConfirm"><i class="ph-fill ph-trash-simple"></i>
                                    Delete Tree
                                </li>
                            </ul>
                        </div>
                        <!--End Right Context Menu-->

                    </div>


                </div>
            </div>
        </div>


        <!--**********************************
          Modal For Page Edit
 ***********************************-->
        <div class="modal fade" tabindex="-1" id="g-sivr-edit-modal" aria-lebeledby="editfile">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">SIVR Page Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="edit-page-form" method="POST"
                          action="{{ route('sivr-pages.update', ['sivr_page' => 'PAGE']) }}">
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="edit_service_title_id">Service Title ID</label>
                                <select class="form-control" name="service_title_id" id="edit_service_title_id">
                                    <option value="123">123</option>
                                    <option value="456">456</option>
                                    <option value="789">789</option>

                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="edit_vivr_id">VIVR ID</label>
                                <select class="form-control" name="vivr_id" id="edit_vivr_id">
                                    <option value="123">123</option>
                                    <option value="456">456</option>
                                    <option value="789">789</option>
                                    <option value="12212">12212</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="edit_task">Task</label>
                                <select class="form-control" name="task" id="edit_task">
                                    <option value="navigation">Navigation</option>
                                    <option value="compare">Compare</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="edit_page_heading_en">Page Heading (EN)</label>
                                <input type="text" class="form-control" name="page_heading_en" id="edit_page_heading_en"
                                       placeholder="Page Heading (EN)">
                            </div>

                            <div class="form-group mb-3">
                                <label for="edit_page_heading_ban">Page Heading (BN)</label>
                                <input type="text" class="form-control" name="page_heading_ban"
                                       id="edit_page_heading_ban"
                                       placeholder="Page Heading (BN)">
                            </div>

                            <div class="form-group mb-3">
                                <label for="edit_has_main_menu">Navigate To Main Page</label>
                                <select class="form-control" name="has_main_menu" id="edit_has_main_menu">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="edit_has_previous_menu">Navigate To Previous Page</label>
                                <select class="form-control" name="has_previous_menu" id="edit_has_previous_menu">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary text-white">Save Changes</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--End Modal For Page Edit-->


        <!--**********************************
                  Modal For Page Add
         ***********************************-->
        <div class="modal fade" tabindex="-1" id="g-sivr-add-modal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">SIVR Page ADD</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="add-page-form" method="POST" action="{{route("sivr-pages.store")}}">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" id="add-parent-page-id" name="parent_page_id" value="">
                            <div class="form-group mb-3">
                                <label for="service_title_id">Service Title ID</label>
                                <select class="form-control" name="service_title_id" id="service_title_id">

                                    <option value="123">123</option>
                                    <option value="456">456</option>
                                    <option value="789">789</option>
                                    <option value="12212">12212</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="vivr_id">VIVR ID</label>
                                <select class="form-control" name="vivr_id" id="vivr_id">
                                    <option value="123">123</option>
                                    <option value="456">456</option>
                                    <option value="789">789</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="task">Task</label>
                                <select class="form-control" name="task" id="task">
                                    <option value="navigation">Navigation</option>
                                    <option value="compare">Compare</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="page_heading_en">Page Heading (EN)</label>
                                <input type="text" class="form-control" name="page_heading_en" id="page_heading_en"
                                       placeholder="Page Heading (EN)">
                            </div>

                            <div class="form-group mb-3">
                                <label for="page_heading_ban">Page Heading (BN)</label>
                                <input type="text" class="form-control" name="page_heading_ban" id="page_heading_ban"
                                       placeholder="Page Heading (BN)">
                            </div>

                            <div class="form-group mb-3">
                                <label for="has_main_menu">Navigate To Main Page</label>
                                <select class="form-control" name="has_main_menu" id="has_main_menu">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="has_previous_menu">Navigate To Previous Page</label>
                                <select class="form-control" name="has_previous_menu" id="has_previous_menu">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary text-white">Add Page</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!--**********************************
                Delete sivr page Alert
         ***********************************-->
        <div id="delete-toast"
             class="toast bg-white d-flex align-items-center justify-content-center position-fixed d-none"
             aria-live="assertive" aria-atomic="true" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">

            <div class="toast-body">
                <h6>Are you sure you want to delete the node?</h6>
                <div class="pt-2 border-top">
                    <form id="delete-sivrPage-form"
                          action="{{ route('sivr-pages.destroy', ['sivr_page' => ':sivrpageid']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button id="delete-confirm" type="submit" class="btn btn-primary btn-sm text-white">Confirm
                        </button>
                        <button id="delete-cancel" type="button" class="btn btn-secondary btn-sm"
                                data-bs-dismiss="toast">Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!--**********************************
      Modal For Audio File Upload
         ***********************************-->
        <div class="modal fade" tabindex="-1" id="g-sivr-audio-upload-modal" aria-lebeledby="audiofileupload">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-lg">
                    <div class="modal-header">
                        <h5 class="modal-title">Audio <i class="ph-fill ph-music-note"></i> File Upload</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6> Audio Upload Here</h6>

                        <form class=" mb-3 w-100" id="audioForm" method="POST"
                              action="{{ route('sivr-pages.save-audio') }}" enctype="multipart/form-data"
                              multiple>
                            @csrf
                            <input type="hidden" id="audio-page-id" name="page_id" value="default">
                            <label for="audioInput_en">Upload english audio file</label>
                            <input class="form-control" type="file" accept="audio/*" name="audio_file_en"
                                   id="audioInput_en"/>

                            <label for="audioInput_ban">Upload bangla audio file</label>
                            <input class="form-control" type="file" accept="audio/*" name="audio_file_ban"
                                   id="audioInput_ban"/>

                            <button class="btn btn-success btn-sm mb-3 mt-3" type="submit">Upload</button>
                        </form>

                        <h6>Uploaded Audio List</h6>
                        <ul id="audioList">

                        </ul>

                        <hr/>
                        <div class="g-player">
                            <audio class="w-100" id="audioPlayer" controls>
                                <source id="audioSource" src="" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <div class="g-player-controls">
                                <button class="btn btn-sm btn-secondary" id="previousButton"><i
                                        class="ph-fill ph-skip-back"></i></button>
                                <button class="btn btn-sm btn-secondary" id="nextButton"><i
                                        class="ph-fill ph-skip-forward"></i>
                                </button>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">


                    </div>
                </div>
            </div>
        </div>

        <!--**********************************
                 Modal For page Element
         ***********************************-->
        <div id="node-element-modal" class="modal fade" tabindex="-1" aria-lebeledby="node-element">

        </div>

        <!--**********************************
      Add New Page Element Modal
 ***********************************-->
        <div class="modal fade" id="addNewPageElement" aria-hidden="true" aria-labelledby="addNewPageElement"
             tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Add New Page Element</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{route("sivr-page-elements.store")}}">
                        <div class="modal-body">

                            <div class="add-new-page-element">

                                @csrf
                                <input type="text" name="page_id" id="page_element_add_page_id">
                                <div class="form-group mb-2">
                                    <label for="g-element-type">Element Type</label>
                                    <select name="type" id="g-element-type" class="form-control">
                                        <option value="button" selected>Button</option>
                                        <option value="input">Input</option>
                                        <option value="table">Table</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="g-element-order">Element Order</label>
                                    <input class="form-control" type="number" name="element_order" id="g-element-order">
                                </div>

                                <div class="form-group mb-2">
                                    <label for="g-element-text-en">Text (EN)</label>
                                    <input class="form-control" type="text" name="display_name_en"
                                           id="g-element-text-en">
                                </div>

                                <div class="form-group mb-2">
                                    <label for="g-element-text-bn">Text (BN)</label>
                                    <input class="form-control" type="text" name="display_name_bn"
                                           id="g-element-text-bn">
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="form-group mb-2">
                                        <label for="g-element-color">Text Color</label>
                                        <input class="form-control" type="color" name="text_color" id="g-element-color">
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="g-element-bg-color">Background Color</label>
                                        <input class="form-control" type="color" name="background_color"
                                               id="g-element-bg-color">
                                    </div>
                                </div>

                                <div id="element-name-area" style="display: none">

                                    <div class="form-group mb-2">
                                        <label for="g-element-text-name">Element Name</label>
                                        <input class="form-control" type="text" name="name" id="g-element-text-name">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="g-element-value">Element Value</label>
                                        <input class="form-control" type="text" name="value" id="g-element-value">
                                    </div>
                                </div>

                                <div id="no-row-column-area" style="display: none">

                                    <div class="form-group mb-2">
                                        <label for="g-element-no-rows">No Of Rows</label>
                                        <input class="form-control" type="number" name="rows" id="g-element-no-rows">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="g-element-no-columns">No Of Columns</label>
                                        <input class="form-control" type="number" name="" id="g-element-no-columns">
                                    </div>

                                </div>

                                <div class="form-group mb-2">
                                    <label for="g-element-visibility">Element Visibility</label>
                                    <select name="is_visible" id="g-element-visibility" class="form-control">
                                        <option value="Y">Visible</option>
                                        <option value="N">Invisible</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="g-element-provider-function">Data Provider Function</label>
                                    <input class="form-control" type="text" name="data_provider_function"
                                           id="g-element-provider-function">
                                </div>


                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Save</button>
                            <button class="btn btn-primary" data-bs-target="node-element-modal" data-bs-toggle="modal">
                                Back
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--**********************************
Edit  New Page Element Modal
***********************************-->
        <div class="modal fade" id="edit-page-element-modal" aria-hidden="true" aria-labelledby="addNewPageElement"
             tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Add New Page Element</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="edit-element-form"
                          action="{{route("sivr-page-elements.update", ['sivr_page_element' => 'PAGE_ELEMENT'])}}">
                        <div class="modal-body">

                            <div class="edit-page-element">

                                @csrf
                                @method('PUT')
                                <div class="form-group mb-2">
                                    <label for="edit-element-type">Element Type</label>
                                    <select name="type" id="edit-element-type" class="form-control">
                                        <option value="button" selected>Button</option>
                                        <option value="input">Input</option>
                                        <option value="table">Table</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="edit-element-order">Element Order</label>
                                    <input class="form-control" type="number" name="element_order"
                                           id="edit-element-order">
                                </div>

                                <div class="form-group mb-2">
                                    <label for="edit-element-text-en">Text (EN)</label>
                                    <input class="form-control" type="text" name="display_name_en"
                                           id="edit-element-text-en">
                                </div>

                                <div class="form-group mb-2">
                                    <label for="edit-element-text-bn">Text (BN)</label>
                                    <input class="form-control" type="text" name="display_name_bn"
                                           id="edit-element-text-bn">
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="form-group mb-2">
                                        <label for="edit-element-color">Text Color</label>
                                        <input class="form-control" type="color" name="text_color"
                                               id="edit-element-color">
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="edit-element-bg-color">Background Color</label>
                                        <input class="form-control" type="color" name="background_color"
                                               id="edit-element-bg-color">
                                    </div>
                                </div>

                                <div id="edit-element-name-area" style="display: none">

                                    <div class="form-group mb-2">
                                        <label for="edit-element-name">Element Name</label>
                                        <input class="form-control" type="text" name="name" id="edit-element-name">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="edit-element-value">Element Value</label>
                                        <input class="form-control" type="text" name="value" id="edit-element-value">
                                    </div>
                                </div>

                                <div id="edit-no-row-column-area" style="display: none">

                                    <div class="form-group mb-2">
                                        <label for="edit-element-no-rows">No Of Rows</label>
                                        <input class="form-control" type="number" name="rows" id="edit-element-no-rows">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="edit-element-no-columns">No Of Columns</label>
                                        <input class="form-control" type="number" name="columns"
                                               id="edit-element-no-columns">
                                    </div>

                                </div>

                                <div class="form-group mb-2">
                                    <label for="edit-element-visibility">Element Visibility</label>
                                    <select name="is_visible" id="edit-element-visibility" class="form-control">
                                        <option value="Y">Visible</option>
                                        <option value="N">Invisible</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="edit-element-provider-function">Data Provider Function</label>
                                    <input class="form-control" type="text" name="data_provider_function"
                                           id="edit-element-provider-function">
                                </div>


                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Save</button>
                            <button class="btn btn-primary" data-bs-target="node-element-modal" data-bs-toggle="modal">
                                Back
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
