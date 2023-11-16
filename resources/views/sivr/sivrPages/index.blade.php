@extends('layout.app')
@section('content')
    @php

        session(['sivrPages'=>$allPages]);

    @endphp

    <main>
        <div class="g-page-content-area">

            <div class="g-page-content-main">
                @if(count($allPages)>0)

                    @foreach($allPages as $sivrPage)

                        <!--**********************************
                                    Right Context Menu
                         ***********************************-->
                        <div id="contextMenu-{{$sivrPage->id}}" class="context-menu">
                            <ul class="list-group">

                                <li class=""
                                ><a href="{{route("sivr-pages.edit", $sivrPage)}}"> <i
                                            class="ph-fill ph-pencil-simple"></i>
                                        Edit</a>
                                </li>
                                <li><a href="{{ url('upload-audio',$sivrPage)}}"><i class="ph-fill ph-upload"></i>
                                        Upload
                                        File</a>
                                </li>
                                <li class=""

                                ><a href="{{route("sivr-page-elements.show",['sivr_page_element'=> $sivrPage])}}"><i
                                            class="ph-fill ph-circles-three-plus"></i>
                                        Node Element</a>
                                </li>
                                <li class="jsDeleteTreeConfirm"><i class="ph-fill ph-trash-simple"></i>
                                    Delete Tree
                                </li>
                            </ul>
                        </div>
                        <!--End Right Context Menu-->
                    @endforeach
                @endif
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
                                                                       nav menu
                                                               ***********************************-->
                                        <div id="navMenu" class="nav-menu">
                                            <ul class="nav-list-group">

                                                <li id="add-option"><a href="{{route('sivr-pages.create')}}">

                                                        <i class="ph-fill ph-plus"></i> {{count($allPages)>0?'Add Branch':'Add root Node'}}
                                                    </a></li>
                                                <li><a href="{{ url('upload-audio')}}"><i class="ph-fill ph-upload"></i>
                                                        Upload
                                                        File</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <!--End nav Menu -->
                                        <div class="file-browser">


                                            <ul>
                                                @if(($rootPage->count() >0))

                                                    @foreach ($rootPage as $sivrPage)
                                                        <li id="{{$sivrPage->id}}" class="{{$sivrPage->hasChildren()?'folder':'file'}} "> <span
                                                                data-sivrpage-id={{$sivrPage->id}} class="node-name">{{$sivrPage->page_heading_en}}</span>


                                                            @include('sivr.sivrPages.children', ['children' => $sivrPage->children])
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>


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
                 aria-live="assertive" aria-atomic="true"
                 style="top: 50%; left: 50%; transform: translate(-50%, -50%);">

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


        </div>
    </main>
@endsection
