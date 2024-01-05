<header id="header"
        class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">
    <div class="navbar-nav-wrap">
        <!-- Logo -->
        <a class="navbar-brand" href="/" aria-label="Front">
            
            
            
            
            
            
            
            
        </a>
        <!-- End Logo -->

        <div class="navbar-nav-wrap-content-start">
            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-arrow-bar-left navbar-toggler-short-align"
                   data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                   data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                <i class="bi-arrow-bar-right navbar-toggler-full-align"
                   data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                   data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
            </button>

            <!-- End Navbar Vertical Toggle -->
        </div>

        <div class="navbar-nav-wrap-content-end">
            <!-- Navbar -->
            <ul class="navbar-nav">
                <?php if(Session::get('switchBackProfileUserId') && Session::get('switchBackProfileUserId')  != Auth::user()->id): ?>

                <a class="btn btn-ghost-secondary btn-sm" href="<?php echo e(route('switch.account', ['school', Session::get('switchBackProfileUserId')])); ?>" >
                    Switch Profile <i class="bi-box-arrow-up-right ms-1"></i>
                  </a>
                <?php endif; ?>
                <!-- Account -->
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown"
                           data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                           data-bs-dropdown-animation>
                            <div class="avatar avatar-sm avatar-secondary avatar-circle">
                                <?php if(Auth::user()->is_admin): ?>
                                    <img class="avatar-img" src="<?php echo e(getAsset('img/profile/admin-profile.png')); ?>" alt="Image">
                                <?php else: ?>
                                    <span class="avatar-initials"><?php echo e(!empty(Auth::user()) ? substr(Auth::user()->name, 0, 1) : ''); ?></span>
                                <?php endif; ?>
                                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                            </div>
                        </a>

                        <div
                            class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
                            aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                            <div class="dropdown-item-text">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm avatar-secondary avatar-circle">
                                        <?php if(Auth::user()->is_admin): ?>
                                            <img class="avatar-img" src="<?php echo e(getAsset('img/profile/admin-profile.png')); ?>" alt="Image">
                                        <?php else: ?>
                                            <span class="avatar-initials"><?php echo e(!empty(Auth::user()) ? substr(Auth::user()->name, 0, 1) : ''); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0"><?php echo e(!empty(Auth::user()) ? Auth::user()->name : ''); ?></h5>
                                        <p class="card-text text-body"><?php echo e(!empty(Auth::user()) ? Auth::user()->email : ''); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="<?php echo e(route('logout')); ?>">Sign out</a>
                        </div>
                    </div>
                </li>
                <!-- End Account -->
            </ul>
            <!-- End Navbar -->
        </div>
    </div>
</header>
<?php /**PATH C:\xampp\htdocs\fin\resources\views/admin/includes/header.blade.php ENDPATH**/ ?>