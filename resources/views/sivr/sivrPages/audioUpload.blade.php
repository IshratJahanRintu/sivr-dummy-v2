@extends('layout.app')
@section('content')
    <main class="g-page-wrap">

        <div class="g-page-content-area mt-2 mt-md-4">

            <div class="g-page-content-main">

                <div class="g-create-form-area">
                    <div class="container-fluid">
                        <div class="g-create-form-main">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header bg-secondary">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="text-white mb-0"> Audio Upload Form </h5>
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

                                                <h5>Audio File Upload <i class="ph-fill ph-music-note"></i></h5>

                                                <form class=" mb-3 w-100" id="audioForm" method="POST"
                                                      action="{{route('sivr-pages.save-audio')}}"
                                                      enctype="multipart/form-data"
                                                      multiple>
                                                    @csrf
                                                    @if($sivrPage)

                                                        <input type="hidden" id="audio-page-id" name="audio_page_id"
                                                               value="{{$sivrPage->id}}">
                                                    @else

                                                        <label for="add-parent-page-id">Parent Page</label>
                                                        <select class="form-control" name="audio_page_id"
                                                                id="add-parent-page-id">
                                                            @foreach($allPages as $page)
                                                                <option

                                                                    value={{$page->id}} {{old('audio_page_id')==$page->id?'selected':''}}>{{$page->page_heading_en}} </option>

                                                            @endforeach

                                                        </select>
                                                    @endif
                                                    <label for="audioInput_ban">Upload bangla audio file</label>
                                                    <input class="form-control" type="file" accept="audio/*"
                                                           name="audio_file_ban"
                                                           id="audioInput_ban" value="{{old('audio_file_ban')}}"/>
                                                    <label for="audioInput_en">Upload english audio file</label>
                                                    <input class="form-control" type="file" accept="audio/*"
                                                           name="audio_file_en"
                                                           id="audioInput_en" value="{{old('audio_file_en')}}"/>



                                                    <button class="btn btn-success btn-sm mb-3 mt-3" type="submit">
                                                        Upload
                                                    </button>
                                                </form>
                                                <!--End Form-->
                                                @if($sivrPage)
                                                    <h6>Uploaded Audio List</h6>
                                                    <ul id="audioList">
                                                        <li @if($sivrPage->audio_file_ban)
                                                                onclick="playAudio('{{ asset('storage/'.$sivrPage->audio_file_ban) }}',0)"
                                                            @endif >
                                                            Bangla Audio
                                                            file:{{$sivrPage->audio_file_ban??'No File Uploaded'}}

                                                            @if($sivrPage->audio_file_ban)
                                                                <button type="button" class="delete-icon-button"
                                                                        onclick="openDeleteConfirmationModal('{{ $sivrPage->audio_file_ban }}', 'bangla'); event.stopPropagation();">
                                                                    <i
                                                                        class="ph-fill ph-trash-simple"></i>
                                                                </button>
                                                            @endif

                                                        </li>


                                                        <li onclick="playAudio('{{ asset('storage/'.$sivrPage->audio_file_en) }}',1)">
                                                            English Audio
                                                            file:{{$sivrPage->audio_file_en??'No File Uploaded'}}
                                                            @if($sivrPage->audio_file_en)
                                                                <button type="button" class="delete-icon-button"
                                                                        onclick="openDeleteConfirmationModal('{{ $sivrPage->audio_file_en }}', 'english'); event.stopPropagation();">
                                                                    <i class="ph-fill ph-trash-simple"></i>
                                                                </button>
                                                            @endif
                                                        </li>
                                                    </ul>

                                                    <hr/>
                                                    <div class="g-player">
                                                        <audio class="w-100" id="audioPlayer" controls>
                                                            <source id="audioSource" src="" type="audio/mpeg">
                                                            Your browser does not support the audio element.
                                                        </audio>

                                                    </div>
                                                @else

                                                @endif


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
    <!-- Delete Confirmation Modal -->

    <div class="modal" id="deleteConfirmationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="closeDeleteConfirmationModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this audio file?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="closeDeleteConfirmationModal()">Cancel
                    </button>
                    <form id="deleteAudioForm" method="POST" action="{{url('sivr-pages/delete-audio',$sivrPage)}}">
                        @csrf
                        <input type="hidden" name="audioFile">
                        <input type="hidden" name="fileType">
                        <button type="button" class="btn btn-danger" onclick="deleteAudio()">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/audio.js')}}"></script>
@endsection

