<!-- Custom table row field -->

<!-- Color -->
<ANY ng-switch-when="color">
        <span class="avatar avatar-xs avatar-circle" style="box-shadow: 0px 0px 4px 0px rgb(128 128 128 / 31%);background-color: {{ row[key] }}">
            <span class="avatar-initials"></span>
        </span>
</ANY>

<!-- True False -->
<ANY ng-switch-when="true-false">
    <i class="me-2" ng-class="{'fad fa-check text-success' : row[key], 'fad fa-times text-danger' : !row[key]}"></i>
    <span class="badge fw-bold {{ row[key]['color'] }}" ng-bind-html="row[key]['name'] | makeHighlight: dataTableFields[key]['name']['val']: pager.dataTableCommonSearch">{{row[key]['name']}}</span>
</ANY>

<!-- Account Status -->
<ANY ng-switch-when="lock">
    <i class="me-2" ng-class="{'fad fa-lock-open text-success' : row[key], 'fad fa-lock text-danger' : !row[key]}"></i>
    <span class="badge fw-bold {{ row[key]['color'] }}" ng-bind-html="row[key]['name'] | makeHighlight: dataTableFields[key]['name']['val']: pager.dataTableCommonSearch">{{row[key]['name']}}</span>
</ANY>

<!-- Clicks Redirect -->
<ANY ng-switch-when="clicks-redirect">
    <div class="btn-group position-unset" role="group">
        <!-- Button Group -->

        <button type="button" class="btn btn-white btn-icon btn-sm" id="table_row_action_dropdown_{{ row.index }}" data-bs-toggle="dropdown" aria-expanded="false" ng-hide="tableRowActionButton.edit.isShow">
            <i class="bi-three-dots"></i></button>

        <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="table_row_action_dropdown_{{ row.index }}">
            <ANY ng-repeat="link in clicksRouts">
                <a href="{{ link.url+row.id }}" class="dropdown-item text-info c-pointer" ><i class="far fa-info-circle dropdown-item-icon text-info"></i> {{ link.name }}</a>

            </ANY>
        </div>
        <!-- End Button Group -->
    </div>
</ANY>






<?php /**PATH C:\xampp\htdocs\fit-fin-phy (1)\fit-fin-phy\resources\views/admin/modals/data-table/table-row-data-custom.blade.php ENDPATH**/ ?>