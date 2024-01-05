<!-- Table loader -->









<!-- End Table Loader -->

<!-- Record not found -->
<ANY ng-hide="isShowTableLoader">
	<div class="card-footer justify-content-center" ng-if="!pager.totalItems">
        <div class="dz-dropzone dz-dropzone-card c-default">
            <div class="dz-message">
                <img class="avatar avatar-xl avatar-4x3 mb-3" src="<?php echo e(getAsset('svg/illustrations/oc-empty-cart.svg')); ?>" alt="Image Description" data-hs-theme-appearance="default">
                <h5>Oops! No Data Found</h5>
                <p class="mb-2">or</p>
                <span class="btn btn-white btn-sm" ng-click="addForm()"><i class="bi-plus"></i> Create New</span>
            </div>
        </div>
	</div>
</ANY>
<!-- End Record not found -->


<div class="card-footer" ng-show="pager.totalItems">
    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
        <div class="col-sm mb-2 mb-sm-0">
            <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                <ANY ng-hide="pager.isAllRecords">
					<span>
						Showing {{ pager.startIndex+1 }} to {{ pager.endIndex+1 }} of {{ pager.totalItems }} entries
					</span>
					<span> — </span>
					<a class="c-pointer" ng-click="viewAllRecords(1)">
						View all
						<i class="fas fa-angle-right ms-1" data-fa-transform="down-1"></i>
					</a>
				</ANY>
				<ANY ng-show="pager.isAllRecords">
					<span>
						Showing {{ pager.totalItems }} entries
					</span>
					<a class="c-pointer" ng-click="viewAllRecords(0)">
						View Less
						<i class="fas fa-angle-up ms-1" data-fa-transform="down-1"></i>
					</a>
				</ANY>
            </div>
        </div>
        <!-- End Col -->

        <!-- Pagination -->
        <div class="col-sm mb-2 mb-sm-0" ng-hide="pager.isAllRecords">
            <nav aria-label="Page navigation example">
                <div class="pagination justify-content-center pagination-btn-group">
                    <a class="btn btn-outline-secondary btn-sm" href="#" tabindex="-1" ng-class="{'disabled':pager.currentPage === 1}" ng-click="setPage(1)">First</a>
                    <a class="btn btn-outline-secondary btn-sm" href="#" aria-label="Prev" ng-class="{'disabled':pager.currentPage === 1}" ng-click="setPage(pager.currentPage - 1)">
                        <span aria-hidden="true">«</span>
                        <span class="visually-hidden">Prev</span>
                    </a>
                    <a class="btn btn-outline-secondary btn-sm" href="#" ng-repeat="page in pager.pages" ng-class="{'active':pager.currentPage === page}" ng-click="setPage(page)">{{ page }}</a>

                    <a class="btn btn-outline-secondary btn-sm" href="#" aria-label="Next" ng-class="{'disabled':pager.currentPage === pager.totalPages}" ng-click="setPage(pager.currentPage + 1)">
                        <span aria-hidden="true">»</span>
                        <span class="visually-hidden">Next</span>
                    </a>

                    <a class="btn btn-outline-secondary btn-sm" href="#" ng-class="{'disabled':pager.currentPage === pager.totalPages}" ng-click="setPage(pager.totalPages)">Last</a>

                </div>
            </nav>
        </div>
        <!-- End Pagination -->

        <div class="col-sm mb-2 mb-sm-0">
            <div class="d-flex justify-content-center justify-content-sm-end">
                <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                    <span class="me-2">Showing:</span>

                    <!-- Select -->
                    <div class="tom-select-custom">
                        <select class=" form-select form-select-borderless w-auto" autocomplete="off" ng-model="pager.pageSize" ng-change="runSearch()">
                            <option value="{{size}}" ng-repeat="size in env.pageSize">{{size}}</option>
                        </select>
                    </div>
                    <!-- End Select -->

                    <span class="text-secondary me-2">entries</span>

                    <!-- Pagination Quantity -->
                </div>
            </div>
        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->
</div>
<?php /**PATH /home/prayosh1/public_html/fit_fin_phy/resources/views/admin/modals/data-table/table-footer.blade.php ENDPATH**/ ?>