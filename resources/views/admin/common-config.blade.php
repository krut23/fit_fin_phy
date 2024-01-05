@extends('admin/layouts/admin-master')
@section('title',!empty($title) ? $title : '')
@section('content')


    <!-- Form -->
    @include('admin.modals.forms.form-modal')
    <!-- End Form -->


@endsection

@section('script')
    <script src="{{asset('resources/angularjs/'.$jsController.'.js')}}"></script>
@endsection
