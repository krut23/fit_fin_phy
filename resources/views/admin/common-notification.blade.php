@extends('admin/layouts/admin-master')
@section('title',!empty($title) ? $title : '')
@section('content')

    <!-- Form -->
    @include('admin.modals.forms.form-modal')
    <!-- End Form -->

    <div class="content container-fluid" ng-if="formOpenType.type === 'form'">
        <div class="row">
            <div class="col-sm-12 col-xl-6" ng-show="sendedNotification.length">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Processing (@{{sendedNotification.length}} / @{{customers.length}})</h5>
                    </div>
                    <div class="card-body">

                        <ANY ng-repeat="noti in sendedNotification">
                            <div class="alert fade show mb-1" ng-class="{'alert-primary': noti.isSuccess == 1, 'alert-danger': noti.isSuccess == 0, 'alert-dark': noti.isSuccess == -1}" role="alert">
                                <strong>@{{noti.id}} - @{{noti.message}}&emsp; </strong>@{{noti.name}}
                            </div>

                        </ANY>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('resources/angularjs/'.$jsController.'.js')}}"></script>
@endsection
