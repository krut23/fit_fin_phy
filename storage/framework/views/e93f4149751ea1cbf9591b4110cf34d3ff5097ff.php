<?php $__env->startSection('title',!empty($title) ? $title : ''); ?>
<?php $__env->startSection('content'); ?>

    <!-- Content -->
    <div class="content container-fluid" ng-if="!imagePreviewUrl && formOpenType.type !== 'form'">
        <!-- Page Header -->
        <?php echo $__env->make('admin.modals.page-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End Page Header -->

        <!-- Card -->
        <?php echo $__env->make('admin.modals.data-table.data-table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End Card -->
    </div>
    <!-- End Content -->

    <!-- Form -->
    <?php echo $__env->make('admin.modals.forms.form-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End Form -->

    <!-- Table Filter -->
    <?php echo $__env->make('admin.modals.data-table.table-filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End Table Filter -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('resources/angularjs/'.$jsController.'.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projects\fit-fin-phy\resources\views/admin/common-list.blade.php ENDPATH**/ ?>