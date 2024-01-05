<?php $__env->startSection('title',!empty($title) ? $title : ''); ?>
<?php $__env->startSection('content'); ?>


    <!-- Form -->
    <?php echo $__env->make('admin.modals.forms.form-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End Form -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('resources/angularjs/'.$jsController.'.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/prayosh1/public_html/fit_fin_phy/resources/views/admin/common-config.blade.php ENDPATH**/ ?>