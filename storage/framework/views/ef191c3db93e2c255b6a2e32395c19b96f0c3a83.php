        <div class="page-header pb-0">
            <div class="row align-items-center mb-3">
                <div class="col-sm mb-2 mb-sm-0">
                    <!-- Breadcrumb -->
                    <?php echo $__env->make('admin.modals.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- End Breadcrumb -->
                    <h1 class="page-header-title">
                        {{ titleP }} <span class="badge bg-soft-dark text-dark ms-2" ng-if="pager.totalItems">{{ pager.totalItems }}</span>
                    </h1>
                </div>
                <!-- End Col -->

                <div class="col-sm-auto">
                    <button class="btn btn-white btn-sm me-2" ng-hide="pageSettingIsHide.buttonCreateNew" ng-click="addForm()"><i class="bi-plus"></i> Create New</button>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
<?php /**PATH /home/prayosh1/public_html/fit_fin_phy/resources/views/admin/modals/page-header.blade.php ENDPATH**/ ?>