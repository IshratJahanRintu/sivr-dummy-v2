
{{--@extends('layout.app')--}}

@dd('hello');
{{--@section('content')--}}
{{--    @php($sivrPage=session('sivrPage'));--}}
{{--    <main class="g-page-wrap">--}}

{{--        <div class="g-page-content-area mt-2 mt-md-4">--}}

{{--            <div class="g-page-content-main">--}}

{{--                <!--**********************************--}}
{{--                        EDIT SIVR PAGE FORM--}}
{{--                 ***********************************-->--}}
{{--                <div class="g-create-form-area">--}}
{{--                    <div class="container-fluid">--}}
{{--                        <div class="g-create-form-main">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-12">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header bg-secondary">--}}
{{--                                            <div class="d-flex justify-content-between">--}}
{{--                                                <h5 class="text-white mb-0"> Edit Form</h5>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            @if ($errors->any())--}}
{{--                                                <div class="alert alert-danger">--}}
{{--                                                    <ul>--}}
{{--                                                        @foreach ($errors->all() as $error)--}}
{{--                                                            <li>{{ $error }}</li>--}}
{{--                                                        @endforeach--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                            <div class="g-create-form">--}}
{{--                                                <!--Start Form-->--}}

{{--                                                <h5 >Audio <i class="ph-fill ph-music-note"></i> File Upload</h5>--}}

{{--                                                <form class=" mb-3 w-100" id="audioForm" method="POST"--}}
{{--                                                      action="{{ route('sivr-pages.save-audio') }}" enctype="multipart/form-data"--}}
{{--                                                      multiple>--}}
{{--                                                    @csrf--}}
{{--                                                    <input type="hidden" id="audio-page-id" name="page_id" value="{{$sivrPage->id}}">--}}
{{--                                                    <label for="audioInput_en">Upload english audio file</label>--}}
{{--                                                    <input class="form-control" type="file" accept="audio/*" name="audio_file_en"--}}
{{--                                                           id="audioInput_en"/>--}}

{{--                                                    <label for="audioInput_ban">Upload bangla audio file</label>--}}
{{--                                                    <input class="form-control" type="file" accept="audio/*" name="audio_file_ban"--}}
{{--                                                           id="audioInput_ban"/>--}}

{{--                                                    <button class="btn btn-success btn-sm mb-3 mt-3" type="submit">Upload</button>--}}
{{--                                                </form>--}}

{{--                                                <h6>Uploaded Audio List</h6>--}}
{{--                                                <ul id="audioList">--}}
{{--                                                    <li >Bangla Audio file:{{$sivrPage->audio_file_ban}}</li>--}}
{{--                                                    <li  >English Audio file:{{$sivrPage->audio_file_en}}</li>--}}
{{--                                                </ul>--}}

{{--                                                <hr/>--}}
{{--                                                <div class="g-player">--}}
{{--                                                    <audio class="w-100" id="audioPlayer" controls>--}}
{{--                                                        <source id="audioSource" src="" type="audio/mpeg">--}}
{{--                                                        Your browser does not support the audio element.--}}
{{--                                                    </audio>--}}
{{--                                                    <div class="g-player-controls">--}}
{{--                                                        <button class="btn btn-sm btn-secondary" id="previousButton"><i--}}
{{--                                                                class="ph-fill ph-skip-back"></i></button>--}}
{{--                                                        <button class="btn btn-sm btn-secondary" id="nextButton"><i--}}
{{--                                                                class="ph-fill ph-skip-forward"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}


{{--                                                <!--End Form-->--}}
{{--                                            </div>--}}


{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!--                End Create Form-->--}}


{{--            </div>--}}
{{--        </div>--}}

{{--    </main>--}}

{{--@endsection--}}

