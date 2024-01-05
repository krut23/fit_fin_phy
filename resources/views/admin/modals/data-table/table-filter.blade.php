<!-- Filter Modal -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="model_offcanvas_table_filter" aria-labelledby="model_offcanvas_table_filterLabel">
    <div class="offcanvas-header">
        <h4 id="model_offcanvas_table_filterLabel" class="mb-0">Filters</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form>
            <!-- Single Search -->
            <ANY ng-repeat="(key, field) in dataTableFields" ng-if="field.isSearchable">
                <span class="text-cap small" for="input_@{{$index}}">@{{field.label}}</span>
                <div class="mb-2">

                    <ANY ng-switch="field.inputType">

                        <!-- Check list box -->
                        <ANY ng-switch-when="check-list">
                            <div class="d-grid gap-2 mb-2">
                                <!-- Form Check -->
                                <div class="form-check" ng-repeat="option in field.select.options">
                                    <input
                                        type="radio"
                                        name="checkbox_group_@{{key}}"
                                        class="form-check-input"
                                        id="checkbox_@{{key}}_@{{option[field.select.valueKey]}}"
                                        value="@{{option[field.select.valueKey]}}"
                                        ng-model="field.val"
                                        ng-change="runSearch()"
                                    />
                                    <label class="form-check-label" for="checkbox_@{{key}}_@{{option[field.select.valueKey]}}">@{{option[field.select.key]}}</label>
                                </div>
                                <!-- End Form Check -->

                            </div>
                        </ANY>
                        <!-- Selection List -->
                        <ANY ng-switch-when="selection-list">
                            <select class="form-select form-select-sm @{{env.FormSettings.formInputSize}}" ng-model="field.val" ng-change="runSearch()">
                                <option value="">@{{ field.select.label }}</option>
                                <option value="@{{option[field.select.valueKey]}}" ng-repeat="option in field.select.options">@{{option[field.select.key]}}</option>
                            </select>
                            <!-- {select: {options: $rootScope.viewData.paymentTypes, key: 'name', valueKey: 'id', label: '- Select Payment Type -'}} -->
                        </ANY>

                        <!-- Selection Search-->
                        <ANY ng-switch-when="selection-search">
                            <div class="form-control select-ul @{{env.FormSettings.formInputSize}}" ng-init="selectUl()">
                                <label ng-click="field.select.search[field.select.key] = ''">
                                    @{{field.select.label ? field.select.label : '- Select '+field.label+' -'}}
                                    <i class="bi-chevron-down  l-icon"></i></label>
                                <ul>
                                    <li ng-show="field.select.isShowSearch">
                                        <input type="text" class="form-control form-select-sm" ng-model="field.select.search[field.select.key]">
                                    </li>
                                    <li class="option" ng-repeat="option in field.select.options | filter: field.select.search"
                                        ng-click="field.val = option.id;field.select.label = option[field.select.key];runSearch()"
                                        ng-class="{'select-ul-active':field.val == option.id}"
                                        >
{{--                                         ng-init="field.val == option.id ? field.select.label = option[field.select.key] : ''"--}}
                                        @{{option[field.select.key]}}
                                        <ANY class="d-none">@{{field.select.label = field.val == option.id ? option[field.select.key] : field.select.label}}</ANY>
                                    </li>
                                </ul>
                            </div>
                        </ANY>

                        <!-- Selection -->
{{--                        <ANY ng-switch-when="selection">--}}
{{--                            <div class="form-control select-ul" ng-init="selectUl()">--}}
{{--                                <label ng-click="fild.select.search[fild.select.key] = ''">@{{fild.select.label ? fild.select.label : fild.label}}<i class="fas fa-sort-down fa-lg l-icon"></i></label>--}}
{{--                                <ul>--}}
{{--                                    <li><input type="text" class="form-control" ng-model="fild.select.search[fild.select.key]"></li>--}}
{{--                                    <li class="option" ng-repeat="option in fild.select.options | filter: fild.select.search" ng-click="fild.val = option.id;fild.select.label = option[fild.select.key];runSearch()" ng-class="{'select-ul-active':fild.val == option.id}" ng-init="fild.val == option.id ? fild.select.label = option[fild.select.key] : ''">--}}
{{--                                        @{{option[fild.select.key]}}--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </ANY>--}}


                        <!-- Date -->
                        <ANY ng-switch-when="date-range">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    From:

                                    <input
                                        name="@{{key}}"
                                        class="form-control @{{env.FormSettings.formInputSize}}"
                                        type="date"
                                        id="input_@{{$index}}"
                                        ng-model="fild.val['from']"
                                        ng-change="runSearch()"
                                    />
                                </div>
                                <div class="col-12 col-sm-6">
                                    To
                                    <input
                                        name="@{{key}}"
                                        class="form-control @{{env.FormSettings.formInputSize}}"
                                        type="date"
                                        id="input_@{{$index}}"
                                        ng-model="fild.val['to']"
                                        ng-change="runSearch()"
                                    />
                                </div>
                            </div>
                        </ANY>

                        <ANY ng-switch-default>
                                <input
                                    type="@{{field.inputType}}"
                                    class="form-control @{{env.FormSettings.formInputSize}}"
                                    name="@{{key}}"
                                    id="input_@{{$index}}"
                                    aria-label="Search @{{field.label}}..."
                                    placeholder="Search @{{field.label}}..."
                                    ng-model="field.val"
                                    ng-change="runSearch()"
                                    onClick="this.select();"
                                >
                        </ANY>

                    </ANY>

                    <a class="link mt-2" href="javascript:;" ng-hide="field.inputType == 'selection-search'" ng-click="field.val = ''; runSearch()">
                        <i class="bi-x"></i> Clear
                    </a>
                    <a class="link mt-2" href="javascript:;" ng-show="field.inputType == 'selection-search'" ng-click="field.val = ''; runSearch(); field.select.label = ''">
                        <i class="bi-x"></i> Clear
                    </a>

                    <hr>
                </div>
            </ANY>
            <!-- End Single Search -->

        </form>

    </div>
    <!-- End Body -->

    <!-- Footer -->
    <div class="offcanvas-footer">
        <div class="row gx-2">
            <div class="col">
                <div class="d-grid">
                    <button type="button" class="btn btn-white btn-sm" ng-click="resetSearch()">Clear all filters</button>
                </div>
            </div>
            <!-- End Col -->

            <div class="col">
                <div class="d-grid">
                    <button type="button" class="btn btn-primary btn-sm" ng-click="runSearch(null, 1)" ng-if="!env.isLiveSearch">Search</button>
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <!-- End Footer -->
</div>
<!-- End Product Filter Modal -->
