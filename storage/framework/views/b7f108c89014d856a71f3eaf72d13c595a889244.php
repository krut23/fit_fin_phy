<nav class="mb-2" aria-label="breadcrumb" ng-if="viewData.breadcrumbs && viewData.breadcrumbs.length">
    <ol class="breadcrumb breadcrumb-no-gutter">
        <li class="breadcrumb-item" ng-repeat="crumb in viewData.breadcrumbs"><a class="breadcrumb-link" href="{{crumb.route}}">{{crumb.label}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ titleP }}</li>
    </ol>
</nav>
<?php /**PATH C:\xampp\htdocs\projects\fit-fin-phy\resources\views/admin/modals/breadcrumb.blade.php ENDPATH**/ ?>