<tbody ng-show="isShowTableLoader">
    <tr ng-repeat="row in [].constructor(5) track by $index" class="data-table-loader">
        <td>
            <div class="dtl dtl-hash"></div>
        </td>
        <td class="align-middle text-nowrap" ng-class="{'table-column-ps-0': $index == 1}" ng-repeat="(key, field) in dataTableFields" ng-if="field.isShowInTable">
            <div class="table-loader-name"></div>
            <ANY ng-switch="field.displayType">

                <!-- Default -->
                <ANY ng-switch-when="image">
                    <div class="dtl dtl-box"></div>
                </ANY>
                <!-- Default -->
                <ANY ng-switch-default>
                    <div class="dtl dtl-text"></div>
                </ANY>
            </ANY>
        </td>

        <th ng-if="statusField"><div class="dtl dtl-text"></div></th>
        <th ng-hide="pageSettingIsHide.rowAction"><div class="dtl dtl-box-action"></div></th>
    </tr>
</tbody>
<?php /**PATH C:\xampp\htdocs\fit-fin-phy\fit-fin-phy\resources\views/admin/modals/data-table/table-loader.blade.php ENDPATH**/ ?>