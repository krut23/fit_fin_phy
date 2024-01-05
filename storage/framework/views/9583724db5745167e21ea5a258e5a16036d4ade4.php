<!DOCTYPE html>
<html lang="en" ng-app="app" ng-controller="rootCtrl">
<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="token" content="<?php echo e(csrf_token()); ?>">

    <!-- Title -->
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(env('APP_NAME')); ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('favicon.png')); ?>">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo e(getAsset('vendor/bootstrap-icons/font/bootstrap-icons.css')); ?>">

    <?php echo $__env->yieldContent('style'); ?>

    <!-- CSS Front Template -->
    <link rel="preload" href="<?php echo e(getAsset('css/theme.min.css')); ?>" data-hs-appearance="default" as="style">
    <link rel="preload" href="<?php echo e(getAsset('css/theme-dark.min.css')); ?>" data-hs-appearance="dark" as="style">


    <!-- Page Css -->
    
    
    
    <link href="<?php echo e(getAsset('css/custom.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(getAsset('fonts/fontawesome_pro_v6/css/all.css')); ?>">
    


    <style data-hs-appearance-onload-styles>
        * {transition: unset !important;}
        body {opacity: 0;}
    </style>

    <!-- Configuration script -->
    <?php echo $__env->make('admin.includes.header-config-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Configuration script end -->

    <!-- Angular js --------------------------------------------------------------------------->
    <!-- Sortable -->

    <!-- Jquery Ui -->


    <!-- Angular Js -->
    <script src="<?php echo e(asset('resources/angularjs/libs/angular.js')); ?>"></script>
    <!-- Cookie -->

    <!-- Toaster -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('resources/angularjs/libs/toaster/toastr.min.css')); ?>">
    <!-- Sanitize -->
    <script src="<?php echo e(asset('resources/angularjs/libs/sanitize/angular-sanitize.min.js')); ?>"></script>
    <!-- Dropzone -->


    <!-- ngDropzone -->


    <!-- Misc -->


</head>

<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl navbar-vertical-aside-closed-mode">


<div class="preloader" id="preloader">
    <div class="loading" aria-busy="true" aria-label="Loading, please wait." role="progressbar">
        <img class="icon" src="<?php echo e(getAsset('img/loader-gear.png')); ?>">
    </div>
</div>
<div class="preloader" ng-show="isLoaderShow">
    <div class="loading" aria-busy="true" aria-label="Loading, please wait." role="progressbar">
        <img class="icon" src="<?php echo e(getAsset('img/loader-gear.png')); ?>">
    </div>
</div>





    <script src="<?php echo e(getAsset('js/hs.theme-appearance.js')); ?>"></script>

    <!-- ========== MAIN CONTENT ========== -->

    <!-- ========== HEADER ========== -->
    <?php echo $__env->make('admin.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- ========== END HEADER ========== -->

    <!-- ========== SIDEBAR ========== -->
    <?php echo $__env->make('admin.includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- ========== END SIDEBAR ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main main-content-body d-none " ng-controller="PageCtrl">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- Hidden Get Route-->
    <?php if(!empty($viewData)): ?>
    <textarea type="text" id="encodedViewData" hidden><?php echo e($viewData); ?></textarea>
    <?php endif; ?>

    <input type="hidden" id="isAdminViewData" value="<?php echo e(Auth::user()->is_admin); ?>" ></input>


    <!-- ========== SECONDARY CONTENTS ========== -->
    <?php echo $__env->yieldContent('secondaryContents'); ?>
    <!-- ========== END SECONDARY CONTENTS ========== -->







    <!-- JS Global Compulsory  -->
    <script src="<?php echo e(getAsset('js/vendor.min.js')); ?>"></script>
    <script src="<?php echo e(getAsset('vendor/jquery/dist/jquery.min.js')); ?>"></script>
    
    

    <!-- JS Implementing Plugins -->
    
    
    
    

    <!-- JS Front -->
    <script src="<?php echo e(getAsset('js/theme.min.js')); ?>"></script>
    <script src="<?php echo e(getAsset('js/theme-custom.js')); ?>"></script>



    <!-- Style Switcher JS -->
    <?php echo $__env->make('admin.includes.footer-config-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End Style Switcher JS -->

    <!-- AngularJs -->
    <script src="<?php echo e(asset('resources/angularjs/libs/sweet-alert/sweetalert.min.js')); ?>"></script>
    <script src="<?php echo e(asset('resources/angularjs/libs/toaster/toastr.min.js')); ?>"></script>

    <script src="<?php echo e(asset('resources/angularjs/libs/moment/moment.min.js')); ?>"></script>

    <script src="<?php echo e(asset('resources/angularjs/libs/wysiwyg-editor/wysiwyg-angular.min.js')); ?>"></script>

    <script src="<?php echo e(asset('resources/angularjs/app.js')); ?>"></script>
    
    <script src="<?php echo e(asset('resources/angularjs/helpers/helperServices.js')); ?>"></script>
    <script src="<?php echo e(asset('resources/angularjs/helpers/helperDirective.js')); ?>"></script>
    <script src="<?php echo e(asset('resources/angularjs/helpers/helperFactory.js')); ?>"></script>
    <script src="<?php echo e(asset('resources/angularjs/helpers/helperFilter.js')); ?>"></script>
    
    <script src="<?php echo e(asset('resources/angularjs/rootCtrl.js')); ?>"></script>
    <?php echo $__env->yieldContent('script'); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\fit-fin-phy\fit-fin-phy\resources\views/admin/layouts/admin-master.blade.php ENDPATH**/ ?>