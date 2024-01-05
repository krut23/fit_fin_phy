<aside
    class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <!-- Logo -->

            <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>" aria-label="Front">



                <h3 class="text-secondary fw-bolder"><?php echo e(env('APP_NAME')); ?></h3>
            </a>

            <!-- End Logo -->

            <!-- Navbar Vertical Toggle -->
            

            <!-- End Navbar Vertical Toggle -->

            <div class="navbar-vertical-content">
                <!-- Content -->
                <?php if(!empty(ACTION_LIST)): ?>
                    <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                        <!-- item group o -->
                        <?php $__currentLoopData = ACTION_LIST; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($group['title'])): ?>
                                <!-- separator title -->
                                <span class="dropdown-header mt-4"><?php echo e($group['title']); ?></span>
                                <!-- separator title end -->
                            <?php endif; ?>
                            <small class="bi-three-dots nav-subtitle-replacer"></small>
                            <!-- Collapse -->
                            <div class="navbar-nav nav-compact"></div>
                            <div id="navbarVerticalMenuPagesMenu">
                                <!-- Collapse -->
                                <?php if(!empty($group['collapsed'])): ?>
                                    <?php $__currentLoopData = $group['collapsed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c => $collapsed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($collapsed['routeName'])): ?>
                                            <?php if(!empty($collapsed['accessRole']) && !in_array($userRoleStatus, $collapsed['accessRole'])): ?> <?php continue; ?> <?php endif; ?>
                                            <!-- main item -->
                                            <div class="nav-item">
                                                <a class="nav-link <?php echo e(isActiveItem($collapsed['activeRoute'])); ?>" href="<?php echo e(route($collapsed['routeName'], !empty($collapsed['params']) ? $collapsed['params'] : [])); ?>" data-placement="left">
                                                    <?php if(!empty($collapsed['icon'])): ?>
                                                        <i class="<?php echo e($collapsed['icon']); ?> nav-icon"></i>
                                                    <?php endif; ?>
                                                    <span class="nav-link-title"><?php echo e($collapsed['label']); ?></span>
                                                </a>
                                            </div>
                                            <!-- main item end -->
                                        <?php else: ?>
                                        <?php if(!empty($collapsed['accessRole']) && !in_array($userRoleStatus, $collapsed['accessRole'])): ?> <?php continue; ?> <?php endif; ?>

                                            <!-- main item dropdown o -->
                                            <div class="nav-item">
                                                <a class="nav-link dropdown-toggle <?php echo e(isActiveItem($collapsed['activeRoute'])); ?>" href="#aria_<?php echo e($c); ?>" role="button"
                                                   data-bs-toggle="collapse" data-bs-target="#aria_<?php echo e($c); ?>"
                                                   aria-expanded="<?php echo e(isAreaExpanded($collapsed['activeRoute'])); ?>" aria-controls="aria_<?php echo e($c); ?>">
                                                    <?php if(!empty($collapsed['icon'])): ?>
                                                        <i class="<?php echo e($collapsed['icon']); ?> nav-icon"></i>
                                                    <?php endif; ?>
                                                    <span class="nav-link-title"><?php echo e($collapsed['label']); ?></span>
                                                </a>

                                                <?php if(!empty($collapsed['item'])): ?>

                                                    <div id="aria_<?php echo e($c); ?>" class="nav-collapse collapse <?php echo e(isActiveCollapse(array_column($collapsed['item'], 'routeName'))); ?>"
                                                         data-bs-parent="#navbarVerticalMenuPagesMenu">
                                                        <?php $__currentLoopData = $collapsed['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(!empty($item['accessRole']) && !in_array($userRoleStatus, $item['accessRole'])): ?> <?php continue; ?> <?php endif; ?>
                                                        <a class="nav-link <?php echo e(isActiveItem($item['activeRoute'])); ?>" href="<?php echo e(route($item['routeName'], !empty($item['params']) ? $item['params'] : [])); ?>">
                                                            <?php echo e($item['label']); ?>


                                                        </a>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <!-- main item dropdown o end -->
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!-- item group o end -->
                    </div>
                <?php endif; ?>
                <!-- End Content -->

                <!-- Footer -->





































                <!-- End Footer -->
            </div>
        </div>
</aside>
<?php /**PATH C:\xampp\htdocs\projects\fit-fin-phy\resources\views/admin/includes/sidebar.blade.php ENDPATH**/ ?>