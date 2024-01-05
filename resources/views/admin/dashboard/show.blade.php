@extends('admin/layouts/admin-master')
@section('title',!empty($title) ? $title : '')
@section('content')

    <div class="content container-fluid">


        <!-- Page Header -->
        <div class="page-header mb-0">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">Dashboard</h1>
                </div>
                <!-- End Col -->


                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <!-- Stats -->
        {{--<div class="row">
            @foreach($countList as $r)
            <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                <!-- Card -->
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2">{{$r['label']}}</h6>

                        <div class="row align-items-center gx-2">
                            <div class="col">
                                <span class="js-counter display-4 text-dark" data-value="{{$r['count']}}">{{$r['count']}}</span>
                                --}}{{--                  <span class="text-body fs-5 ms-1">from 22</span>--}}{{--
                            </div>
                            <!-- End Col -->

                            <div class="col-auto">
                                --}}{{--                  <span class="badge bg-soft-success text-success p-1">--}}{{--
                                --}}{{--                    <i class="bi-graph-up"></i> 5.0%--}}{{--
                                --}}{{--                  </span>--}}{{--
                            </div>
                            <!-- End Col -->
                        </div>
                        <!-- End Row -->
                    </div>
                </div>
                <!-- End Card -->
            </div>
            @endforeach

        </div>--}}
        <!-- End Stats -->


    </div>

@endsection
@section('script')
    <script src="{{asset('resources/angularjs/dashboardCtrl.js')}}"></script>

    <script>

    </script>
@endsection
