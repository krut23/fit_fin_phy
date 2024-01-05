<td class="align-middle text-nowrap" ng-if="statusField">
    <ANY ng-repeat="(keyStatus, statusRow) in statusField">
        <ANY ng-switch="statusRow.status">
            <ANY ng-switch-when="is-active">
                <i class="fad fa-circle me-2" ng-class="{'text-disabled-gray' : !row[keyStatus], 'text-success' : row[keyStatus]}"></i>
            </ANY>

            <ANY ng-switch-when="is-archive">
                <i class="bi-archive-fill me-2" ng-class="{'text-disabled-gray' : !row[keyStatus], 'text-warning' : row[keyStatus]}"></i>
            </ANY>

            <ANY ng-switch-when="is-verified">
                <i class="fas me-2" ng-class="{'fa-badge text-disabled-gray' : !row[keyStatus], 'fa-badge-check text-success' : row[keyStatus]}"></i>
            </ANY>

            <ANY ng-switch-when="task-status">
                <i class="fas me-2" ng-if="[0,1].includes(row[keyStatus])" ng-class="{'fa-thumbs-up text-disabled-gray' : row[keyStatus] == 0, 'fa-thumbs-up text-info' : row[keyStatus] == 1}"></i>
            </ANY>
            <ANY ng-switch-when="show-hide">
                <i class="fad me-2" ng-class="{'fa-eye-slash text-danger' : row[keyStatus] == 0, 'fa-eye text-success' : row[keyStatus] == 1}"></i>
            </ANY>













            <!-- Custom status field ---------------------------------------- -->

        </ANY>

    </ANY>
</td>
<?php /**PATH C:\xampp\htdocs\fit-fin-phy (1)\fit-fin-phy\resources\views/admin/modals/data-table/table-row-data-status.blade.php ENDPATH**/ ?>