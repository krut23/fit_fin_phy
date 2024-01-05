<!-- image preview card -->
<div class="row g-3 mb-3" ng-if="imagePreviewUrl">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header pb-0">
                <h5 class="d-block">
                    <a class="float-end" type="button" ng-click="showImagePreview()"><i class="far fa-times"></i></a>
                </h5>
            </div>
            <div class="card-body bg-light">
                <div class="row">
                    <div class="col-xl-6 col-md-8 offset-xl-3 offset-md-2">
                        <div class="card">
                            <img class="img-fluid" ng-src="@{{imagePreviewUrl}}" alt="image-preview">
                        </div>
                        <form class="theme-form text-center">
                            <a class="btn btn-primary" href="@{{imagePreviewUrl}}" download>Download
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- image preview card end -->