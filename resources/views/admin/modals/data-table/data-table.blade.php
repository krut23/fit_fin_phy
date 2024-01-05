    <!-- Card -->
        <div class="card _dataTable">
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
                <div class="mb-2 mb-md-0">
                    <form>
                        <!-- Search -->
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend input-group-text">
                                <i class="bi-search"></i>
                            </div>
                            <input id="datatableSearch" type="search" class="form-control text-primary" placeholder="Search @{{ titleP }}..." aria-label="Search @{{ titleP }}" ng-model="pager.dataTableCommonSearch" ng-change="runSearch('common')" ng-hide="pageSettingIsHide.commonSearch">
                        </div>
                        <!-- End Search -->
                    </form>
                </div>

                <div class="d-grid d-sm-flex gap-2">
                    <button class="btn btn-white btn-sm" type="button" ng-hide="pageSettingIsHide.rowFilters" data-bs-toggle="offcanvas" data-bs-target="#model_offcanvas_table_filter" aria-controls="model_offcanvas_table_filter">
                        <i class="bi-filter me-1"></i> Filters
                    </button>

                    <!-- Dropdown -->
                    <div class="dropdown" ng-hide="pageSettingIsHide.columnAction">
                        <button type="button" class="btn btn-white btn-sm w-100" id="showHideDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            <i class="bi-table me-1"></i> Columns <span class="badge bg-soft-dark text-dark rounded-circle ms-1" ng-if="dataTableFieldTotalColumn">@{{ dataTableFieldTotalColumn }}</span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end dropdown-card" aria-labelledby="showHideDropdown" style="width: 15rem;">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="d-grid gap-3">
                                        <!-- Form Switch -->
{{--                                        pageSettingIsHide.columnAction--}}
                                        <label class="row form-check form-switch" for="data_table_toggle_column_@{{key}}" ng-repeat="(key, field) in dataTableFields" ng-if="field.isShowInTableChecked">
                                            <span class="col-8 col-sm-9 ms-0">
                                                <span class="me-2">@{{field.label}}</span>
                                            </span>
                                            <span class="col-4 col-sm-3 text-end">
                                                <input type="checkbox" class="form-check-input" id="data_table_toggle_column_@{{key}}"  ng-checked="field.isShowInTable" ng-click="field.isShowInTable = !field.isShowInTable" >
                                            </span>
                                        <!-- Form Switch end -->
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Dropdown -->
                </div>
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" ng-class="{'table-hover': !isShowTableLoader}">
                    <!-- Table heading -->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="table-column-pe-0">#</th>
                            <!-- Single column -->
                            <th ng-repeat="(key, field) in dataTableFields" ng-if="field.isShowInTable">@{{field.label}}
                                <div class="btn-group p-l pointer" role="group" aria-label="Basic example" ng-if="field.isSortable">
                                    <i class="fad fa-sort fa-lg" ng-class="{'fa-sort-up': currentShortingOrderIcon=='ASC_'+key, 'fa-sort-down': currentShortingOrderIcon=='DESC_'+key}" ng-click="setShort(key)"></i>
                                </div>
                            </th>
                             <!-- ng-class="{'table-column-ps-0': $index == 1}" -->
                            <!-- Single column end -->
                            <th ng-if="statusField">Status</th>
                            <th ng-hide="pageSettingIsHide.rowAction">Action</th>
                        </tr>
                    </thead>
                    <!-- End Table heading -->

                    <!-- Table body -->
                    <tbody>
                        <tr ng-repeat="row in pager.filteredData">
                            <td class="table-column-pe-0">@{{ row.index }}</td>

                            <!-- Table row data -->
                            @include('admin.modals.data-table.table-row-data')
                            <!-- Table row data end -->

                            <!-- Table row status status -->
                            @include('admin.modals.data-table.table-row-data-status')
                            <!-- Table row status status end -->



                            <td ng-hide="pageSettingIsHide.rowAction">
                                <div class="btn-group position-unset" role="group">
                                    <a class="btn btn-white btn-sm" ng-if="tableRowActionButton.edit.isShow" ng-click="setEditForm(row.id)">
                                        <i class="bi-pencil-fill me-1"></i> Edit
                                    </a>

                                    <!-- Button Group -->
                                    <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="table_row_action_dropdown_@{{ row.index }}" data-bs-toggle="dropdown" aria-expanded="false" ng-show="tableRowActionButton.edit.isShow"></button>

                                    <button type="button" class="btn btn-white btn-icon btn-sm" id="table_row_action_dropdown_@{{ row.index }}" data-bs-toggle="dropdown" aria-expanded="false" ng-hide="tableRowActionButton.edit.isShow"><i class="bi-three-dots"></i></button>

                                    <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="table_row_action_dropdown_@{{ row.index }}">
                                        <ANY ng-repeat="(key, button) in tableRowActionButton">
                                            <ANY ng-if="button.isShow" ng-switch="key">
                                                <ANY ng-switch-when="delete">
                                                    <a class="dropdown-item text-danger c-pointer" ng-click="deleteData(row.id)"><i class="bi-trash dropdown-item-icon text-danger"></i> Delete</a>
                                                </ANY>
                                                <ANY ng-switch-when="details">
                                                    <a class="dropdown-item text-info c-pointer" href="@{{row.detailsUrl}}"><i class="bi-info-circle dropdown-item-icon text-info"></i> Details</a>
                                                </ANY>

                                                <ANY ng-switch-when="meta">
                                                    <a class="dropdown-item text-primary c-pointer"  ng-click="setEditForm(row.id, 1)"><i class="bi-hdd-rack dropdown-item-icon text-primary"></i> Details</a>
                                                </ANY>

                                                <!-- Table row action button custom -->
                                                @include('admin.modals.data-table.table-row-action-button-custom')
                                                <!-- Table row action button custom end -->

                                                <ANY ng-switch-default></ANY>
                                            </ANY>

                                        </ANY>
                                    </div>
                                    <!-- End Button Group -->
                                </div>
                            </td>
                        </tr>


                    </tbody>
                    <!-- End Table body -->

                    <!-- Table body -->
                    @include('admin.modals.data-table.table-loader')
                    <!-- End Table body -->

                </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
            @include('admin.modals.data-table.table-footer')
            <!-- End Footer -->
        </div>
        <!-- End Card -->
