@extends('admin/layouts/admin-master')
@section('title',!empty($title) ? $title : '')
@section('content')

    <!-- Content -->
    <div class="content container-fluid" ng-if="!imagePreviewUrl && formOpenType.type !== 'form'">
        <!-- Page Header -->
        @include('admin.modals.page-header')
        <!-- End Page Header -->

        <!-- Card -->
        @include('admin.modals.data-table.data-table')
        <!-- End Card -->
    </div>
    <!-- End Content -->

    <!-- Form -->
    @include('admin.modals.forms.form-modal')
    <!-- End Form -->

    <!-- Table Filter -->
    @include('admin.modals.data-table.table-filter')
    <!-- End Table Filter -->

@endsection

@section('script')
    <script src="{{asset('resources/angularjs/'.$jsController.'.js')}}"></script>
@endsection
