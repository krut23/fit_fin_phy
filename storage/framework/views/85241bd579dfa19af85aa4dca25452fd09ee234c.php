<td class="align-middle text-nowrap" ng-repeat="(key, field) in dataTableFields"
    ng-if="field.isShowInTable">
    
    <ANY ng-switch="field.displayType">

        <!-- Custom table field -->
        <?php echo $__env->make('admin.modals.data-table.table-row-data-custom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Custom table field end -->

        <!-- Image -->
        <ANY ng-switch-when="image">
            <ANY ng-if="row[key]">
                <img class="{{field.className}}" ng-show="field.className" alt="icon" ng-src="{{row[key]}}"/>
                <img class="avatar avatar-lg" ng-hide="field.className" alt="icon" ng-src="{{row[key]}}"/>
                
                

            </ANY>
        </ANY>
        <!-- Image end -->

        <!-- Image -->
        <ANY ng-switch-when="profile-image">
            <ANY ng-if="row[key]" class="avatar-circle">
                <img class="{{field.className}}" ng-show="field.className" alt="icon" ng-src="{{row[key]}}"/>
                <img class="avatar avatar-lg" ng-hide="field.className" alt="icon" ng-src="{{row[key]}}"/>
            </ANY>
        </ANY>
        <!-- Image end -->


        <!-- Badge -->
        <ANY ng-switch-when="badge">
            <span class="{{row.className}}" ng-show="row.className" ng-bind-html="row[key] | makeHighlight: dataTableFields[key]['val']: pager.dataTableCommonSearch">{{row[key]}}</span>
            <span class="badge bg-secondary" ng-hide="row.className" ng-bind-html="row[key] | makeHighlight: dataTableFields[key]['val']: pager.dataTableCommonSearch">{{row[key]}}</span>
            <!-- EXAMPLE: key: {displayType: 'badge', class: 'badge bg-primary'}, -->
        </ANY>
        <!-- Badge end -->

        <!-- Id -->
        <ANY ng-switch-when="id">
            <span class="badge bg-soft-dark text-dark fw-bold" ng-bind-html="row[key] | makeHighlight: dataTableFields[key]['val']: pager.dataTableCommonSearch">#{{row[key]}}</span>
        </ANY>
        <!-- Id end -->

        <!-- link -->
        <ANY ng-switch-when="link">
            <a href="{{row[key]}}" ng-if="row[key]"> <i class="bi-link-45deg me-1 fs-1 text-primary "></i> </a>
        </ANY>
        <!-- link end -->

        <!-- Attachment -->
        <ANY ng-switch-when="attachment">
            <a href="{{row[key]}}" ng-if="row[key]" target="_blank">
                <i class="far fa-paperclip me-1 fs-1 text-primary "></i> </a>
        </ANY>
        <!-- Attachment end -->

        <!-- Redirect Text -->
        <ANY ng-switch-when="redirect-text">
            <a href="{{row[key].redirectUrl}}"> {{ row[key].label }} &ensp;<i class="far fa-external-link  text-primary "></i>
            </a>
        </ANY>
        <!-- Redirect Text end -->


        <!-- Date -->
        <ANY ng-switch-when="date">
            <span class="{{row.className}}">{{row[key] | getDateFormat}}</span>
            <!-- EXAMPLE: key: {displayType: 'badge', className: 'badge bg-primary'}, -->
        </ANY>
        <!-- Date end -->

        
        <!-- Flip Btn Status -->
        <ANY ng-switch-when="flip-btn-status">

        <button class="c-toggle-btn " ng-class="{'success': row[key] == 1, 'danger': row[key] != 1}" ng-click="changeStatus(row.id);row[key] = row[key] == 1 ? 0 : 1 ">
             <span ng-if="new Date(row.last_login_at) >= new Date()">Active</span>
             <span ng-if="new Date(row.last_login_at) < new Date()">Inactive</span>
            {{ row[key] == 1 ? 'Active' : 'Inactive' }}
        </button> 


        </ANY>
        <!-- Flip Btn Status -->


        <!-- Description -->
        <ANY ng-switch-when="description">
            <ANY ng-show="row.isShowNote || field.val">
                <ANY ng-bind-html="row[key] | makeHighlight: dataTableFields[key]['val']: pager.dataTableCommonSearch"></ANY>&emsp;
            </ANY>
            <u ng-hide="field.val || !row[key]"> <a href="" ng-click="row.isShowNote = !row.isShowNote">
                    <b ng-hide="row.isShowNote">Read <i class="fad fa-angle-double-right"></i></b>
                    <b ng-show="row.isShowNote">Hide <i class="fad fa-angle-double-up"></i></b> </a> </u>
        </ANY>

        <!-- Default -->
        <ANY ng-switch-default>
            <ANY ng-bind-html="row[key] | makeHighlight: dataTableFields[key]['val']: pager.dataTableCommonSearch"></ANY>
            <!-- Default end -->
        </ANY>
    </ANY>
</td>
<?php /**PATH C:\xampp\htdocs\fin\resources\views/admin/modals/data-table/table-row-data.blade.php ENDPATH**/ ?>