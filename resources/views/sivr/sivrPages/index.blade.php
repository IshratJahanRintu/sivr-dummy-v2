@extends('layout.app')
@section('content')
    @php
        $sivrPagesJson = $allPages->toJson()
    @endphp

    <script>
        let sivrPagesJson = {!!   $sivrPagesJson !!};
    </script>
    <main>
    <div class="g-page-content-area">

        <div class="g-page-content-main">
            @foreach($allPages as $sivrPage)
                <!--**********************************
                                    Right Context Menu
                         ***********************************-->
                <div id="contextMenu-{{$sivrPage->id}}" class="context-menu">
                    <ul class="list-group">

                        <li  class=""
                        ><a href="{{route("sivr-pages.edit", $sivrPage)}}"> <i class="ph-fill ph-pencil-simple"></i>
                                Edit</a>
                        </li>

                        <li class=""

                            ><a href="{{route("sivr-page-elements.show",['sivr_page_element'=> $sivrPage])}}"><i class="ph-fill ph-circles-three-plus"></i>
                            Node Element</a>
                        </li>
                        <li  class="jsDeleteTreeConfirm"> <i class="ph-fill ph-trash-simple"></i>
                            Delete Tree
                        </li>
                    </ul>
                </div>
                <!--End Right Context Menu-->
            @endforeach

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
                                    <!-- **********************************
                                                                      Right Context Menu
                                                           ***********************************-->
                                    <div id="navMenu" class="nav-menu">
                                        <ul class="nav-list-group">

                                            <li id="add-option"><a href="{{route('sivr-pages.create')}}">
                                                    <i class="ph-fill ph-plus"></i> Add Branch
                                                </a></li>
                                            <li ><a href="{{ route('sivr-pages.upload-audio')}}"><i class="ph-fill ph-upload"></i> Upload
                                                File</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--End Right Context Menu -->
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


                    </div>


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
        <div class="modal fade" tabindex="-1" id="g-sivr-audio-upload-modal" >
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

    </div>
    </main>
@endsection
