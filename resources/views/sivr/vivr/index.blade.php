@extends('layout.app')
@section('content')

    <main class="g-page-wrap">

        <div class="g-page-content-area mt-2 mt-md-4">

            <div class="g-page-content-main">
                <!--**********************************
                                 Showings  page Elements
                         ***********************************-->

                <div class="container-fluid px-5 ">
                    <div class="text-end mb-3">
                        <button class="btn btn-outline-primary btn-sm d-inline-flex align-items-center gap-1"
                        ><a href={{route('vivr.create')}}><i class="bi bi-plus"></i> Add
                                New </a>
                        </button>
                    </div>
                    <div class="container mt-5">
                        <table class="table table-bordered table-responsive  table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="fw-bold text-center">Serial</th>
                                    <th scope="col" class="fw-bold text-center">Vivr Name</th>
                                <th scope="col" class="fw-bold text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $serialNumber = 1; // Initialize the serial number
                            @endphp

                            @foreach($vivrList as $vivr)
                                <tr>
                                    <td class="text-center">{{$serialNumber}}</td>
                                    <td class="text-center">{{$vivr->title}} </td>
                                <td class="text-center"> <i class="ph-fill ph-trash-simple delete-vivr-btn delete-icon-button text-danger" data-vivr-id="{{$vivr->id}}"></i></td>
                                </tr>

                                @php
                                    $serialNumber++; // Increment the serial number
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- Delete Confirmation Modal -->

        <!--**********************************
               Delete sivr page Alert
        ***********************************-->
        <div id="delete-toast"
             class="toast bg-white d-flex align-items-center justify-content-center position-fixed d-none"
             aria-live="assertive" aria-atomic="true" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">

            <div class="toast-body">
                <h6>Are you sure you want to delete the node?</h6>
                <div class="pt-2 border-top">
                    <form id="delete-vivr-form"
                          action="{{ route('vivr.destroy', ['vivr' => ':vivrId']) }}" method="POST">
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

    </main>
    <script src="{{asset('assets/js/vivr-index.js')}}"></script>
@endsection
