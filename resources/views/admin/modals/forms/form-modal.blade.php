<!-- Form -->
<div class="content container-fluid" ng-if="formOpenType.type === 'form'">
    <div class="row">
        <div class="col-12 mb-3 mb-lg-0" ng-class="{'col-lg-6':formOpenType.size === 6, 'col-lg-12':formOpenType.size === 12}">
            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <div class="card-header card-header-content-between">
                    <h4 class="card-header-title">@{{ modalTitle }}</h4>
                    {{--<button type="button" class="btn btn-ghost-dark btn-icon btn-sm rounded-circle" ng-click="newFormOpenType()">
                        <i class="bi-x-lg"></i>
                    </button>--}}
                </div>
                <!-- End Header -->
                <!-- Body -->
                <div class="card-body">
                    <form class="all-form-reset">
                        <!-- Row -->
                        <div class="row">
                            <!-- Include input -->
                            @include('admin.modals.forms.form-input')
                            <!-- End Include input-->
                        </div>
                        <!-- End Row -->
                    </form>
                </div>
                <!-- Body -->

                <!-- Footer -->
                <div class="card-footer d-flex justify-content-end align-items-center">
                    <button type="button" class="btn btn-secondary btn-sm me-2"  ng-hide="pageSettingIsHide.formCancel" ng-click="newFormOpenType()">Cancel</button>
                    <button type="button" class="btn btn-primary btn-sm" ng-click="saveData()">Save</button>
                </div>
                <!-- End Footer -->

            </div>
            <!-- End Card -->
        </div>
    </div>
</div>
<!-- End Form -->

<!-- Form Modal -->
<div class="modal fade" id="add_edit_model" ng-if="formOpenType.type === 'modal'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog @{{ formOpenType.size }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">@{{ modalTitle }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="all-form-reset">
                    <!-- Row -->
                    <div class="row">
                        <!-- Include input -->
                        @include('admin.modals.forms.form-input')
                        <!-- End Include input-->
                    </div>
                    <!-- End Row -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm me-2"  ng-hide="pageSettingIsHide.formCancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" ng-click="saveData()">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- End Form Modal -->
