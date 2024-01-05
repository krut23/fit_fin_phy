@extends('admin/layouts/admin-master')
@section('title',!empty($title) ? $title : '')
@section('content')

    <!-- Content -->
    <div class="content container-fluid">

        <div class="page-header pb-0 mb-0">
            <div class="row align-items-center">
                <div class="col-sm mb-sm-0">

                    <h1 class="page-header-title">
                        @{{ titleP }}
                        <span class="badge bg-soft-dark text-dark ms-2" ng-if="pager.totalItems">@{{ pager.totalItems }}</span>
                    </h1>
                </div>
                <!-- End Col -->

            </div>
            <!-- End Row -->
        </div>
    </div>
    <!-- End Content -->

    <!-- Content -->
    <div class="content container-fluid">

        <div class="row">
            <div class="col-6 col-sm-2">
                From:

                <input
                    class="form-control "
                    type="date"
                    ng-model="chartFilters.fromDate"
                    ng-change="getChartData()"
                />
            </div>
            <div class="col-6 col-sm-2">
                To
                <input
                    class="form-control "
                    type="date"
                    ng-model="chartFilters.toDate"
                    ng-change="getChartData()"
                />
            </div>


        </div>

        <div class="chartBox">

        </div>
        <button class="btn btn-secondary btn-sm mt-3 float-end" ng-click="downloadChart()">Download</button>

    </div>
    <!-- End Content -->

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset('resources/angularjs/'.$jsController.'.js')}}"></script>
    <script>


    </script>
@endsection
