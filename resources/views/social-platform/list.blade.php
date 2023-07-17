@extends('layout.app')

@section('content')
<main class="g-page-wrap">

    <div class="g-page-content-area">

        <div class="g-page-content-main">

            <!--**********************************
                    Visualization & Graph
             ***********************************-->

            <div class="container-fluid position-relative">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body p-4">
                                <div class="row">
                                    @if(isset($dataPack->data))
                                        @foreach ($dataPack->data as $items)
                                            <div class="col-md-4">
                                                <a href="">
                                                    <div class="g-box-area">
                                                        @if($items == 'Facebook') <img class="img-fluid" src="{{ asset('assets/images/social-platforms/icons8-facebook-144.png') }}" alt="{{$items}}"> @endif
                                                        @if($items == 'Instagram') <img class="img-fluid" src="{{ asset('assets/images/social-platforms/icons8-instagram-144.png') }}" alt="{{$items}}"> @endif
                                                        @if($items == 'WhatsApp') <img class="img-fluid" src="{{ asset('assets/images/social-platforms/icons8-whatsapp-144.png') }}" alt="{{$items}}"> @endif
                                                        @if($items == 'Youtube') <img class="img-fluid" src="{{ asset('assets/images/social-platforms/icons8-youtube-144.png') }}" alt="{{$items}}"> @endif
                                                        @if($items == 'Tiktok') <img class="img-fluid" src="{{ asset('assets/images/social-platforms/icons8-tiktok-144.png') }}" alt="{{$items}}"> @endif
                                                        @if($items == 'Twitter') <img class="img-fluid" src="{{ asset('assets/images/social-platforms/icons8-twitter-144.png') }}" alt="{{$items}}"> @endif
                                                    <h3>{{$items}}</h3>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection

