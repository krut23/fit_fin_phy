
<link href="<?php echo e(asset('css/custom-theme.css')); ?>" rel="stylesheet">
<?php $__env->startSection('content'); ?>
<div ng-controller="PageCtrl" class="dashboard">
  <h1><?php echo e($titleS); ?></h1>
  

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        
        <th>Active</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($item->id); ?></td>
          <td><?php echo e($item->profile_url); ?></td>
          <td><?php echo e($item->name); ?></td>
          <td><?php echo e($item->phone); ?></td>
          <td><?php echo e($item->email); ?></td>
          
          <td>
            <?php if($item->is_active == 1): ?>
              <button class="btn btn-success">Active</button>
            <?php else: ?>
              <button class="btn btn-danger">Inactive</button>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\fit-fin-phy\resources\views/inactive.blade.php ENDPATH**/ ?>