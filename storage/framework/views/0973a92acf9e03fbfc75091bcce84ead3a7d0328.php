<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    

    <!-- Favicon -->
    

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo e(getAsset('vendor/bootstrap-icons/font/bootstrap-icons.css')); ?>">

    <!-- CSS Front Template -->

    <link rel="preload" href="<?php echo e(getAsset('css/theme.min.css')); ?>" data-hs-appearance="default" as="style">
    <link rel="preload" href="<?php echo e(getAsset('css/theme-dark.min.css')); ?>" data-hs-appearance="dark" as="style">

    <link href="<?php echo e(getAsset('css/custom.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(getAsset('css/custom-theme.css')); ?>" rel="stylesheet">
    <style data-hs-appearance-onload-styles>
        * {
            transition: unset !important;
        }

        body {
            opacity: 0;
        }
    </style>

    <script>
        window.hs_config = {
            'autopath': '@autopath',
            'deleteLine': 'hs-builder:delete',
            'deleteLine:build': 'hs-builder:build-delete',
            'deleteLine:dist': 'hs-builder:dist-delete',
            'previewMode': false,
            'startPath': '/index.html',
            'vars': {
                'themeFont': 'https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap',
                'version': '?v=1.0'
            },
            'layoutBuilder': {
                'extend': { 'switcherSupport': true },
                'header': { 'layoutMode': 'default', 'containerMode': 'container-fluid' },
                'sidebarLayout': 'default'
            },
            'themeAppearance': {
                'layoutSkin': 'default',
                'sidebarSkin': 'default',
                'styles': {
                    'colors': {
                        'primary': '#377dff',
                        'transparent': 'transparent',
                        'white': '#fff',
                        'dark': '132144',
                        'gray': { '100': '#f9fafc', '900': '#1e2022' }
                    }, 'font': 'Inter'
                }
            },
            'languageDirection': { 'lang': 'en' },
            'skipFilesFromBundle': {
                'dist': ['assets/js/hs.theme-appearance.js', 'assets/js/hs.theme-appearance-charts.js', 'assets/js/demo.js'],
                'build': ['assets/css/theme.css', 'assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js', 'assets/js/demo.js', 'assets/css/theme-dark.css', 'assets/css/docs.css', 'assets/vendor/icon-set/style.css', 'assets/js/hs.theme-appearance.js', 'assets/js/hs.theme-appearance-charts.js', 'node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js', 'assets/js/demo.js']
            },
            'minifyCSSFiles': ['assets/css/theme.css', 'assets/css/theme-dark.css'],
            'copyDependencies': {
                'dist': { '*assets/js/theme-custom.js': '' },
                'build': { '*assets/js/theme-custom.js': '', 'node_modules/bootstrap-icons/font/*fonts/**': 'assets/css' }
            },
            'buildFolder': '',
            'replacePathsToCDN': {},
            'directoryNames': { 'src': './src', 'dist': './dist', 'build': './build' },
            'fileNames': {
                'dist': { 'js': 'theme.min.js', 'css': 'theme.min.css' },
                'build': {
                    'css': 'theme.min.css',
                    'js': 'theme.min.js',
                    'vendorCSS': 'vendor.min.css',
                    'vendorJS': 'vendor.min.js'
                }
            },
            'fileTypes': 'jpg|png|svg|mp4|webm|ogv|json'
        };
        window.hs_config.gulpRGBA = (p1) => {
            const options = p1.split(',');
            const hex = options[0].toString();
            const transparent = options[1].toString();

            var c;
            if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
                c = hex.substring(1).split('');
                if (c.length == 3) {
                    c = [c[0], c[0], c[1], c[1], c[2], c[2]];
                }
                c = '0x' + c.join('');
                return 'rgba(' + [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(',') + ',' + transparent + ')';
            }
            throw new Error('Bad Hex');
        };
        window.hs_config.gulpDarken = (p1) => {
            const options = p1.split(',');

            let col = options[0].toString();
            let amt = -parseInt(options[1]);
            var usePound = false;

            if (col[0] == '#') {
                col = col.slice(1);
                usePound = true;
            }
            var num = parseInt(col, 16);
            var r = (num >> 16) + amt;
            if (r > 255) {
                r = 255;
            } else if (r < 0) {
                r = 0;
            }
            var b = ((num >> 8) & 0x00FF) + amt;
            if (b > 255) {
                b = 255;
            } else if (b < 0) {
                b = 0;
            }
            var g = (num & 0x0000FF) + amt;
            if (g > 255) {
                g = 255;
            } else if (g < 0) {
                g = 0;
            }
            return (usePound ? '#' : '') + (g | (b << 8) | (r << 16)).toString(16);
        };
        window.hs_config.gulpLighten = (p1) => {
            const options = p1.split(',');

            let col = options[0].toString();
            let amt = parseInt(options[1]);
            var usePound = false;

            if (col[0] == '#') {
                col = col.slice(1);
                usePound = true;
            }
            var num = parseInt(col, 16);
            var r = (num >> 16) + amt;
            if (r > 255) {
                r = 255;
            } else if (r < 0) {
                r = 0;
            }
            var b = ((num >> 8) & 0x00FF) + amt;
            if (b > 255) {
                b = 255;
            } else if (b < 0) {
                b = 0;
            }
            var g = (num & 0x0000FF) + amt;
            if (g > 255) {
                g = 255;
            } else if (g < 0) {
                g = 0;
            }
            return (usePound ? '#' : '') + (g | (b << 8) | (r << 16)).toString(16);
        };
    </script>
</head>

<body>

<script src="<?php echo e(getAsset('js/hs.theme-appearance.js')); ?>"></script>

<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="main custom-login" style="background-image: url('<?php echo e(getAsset('img/auth-bg.png')); ?>') ">
    
    

    <!-- Content -->
    <div class="container py-5 py-sm-7">
        <a class="d-flex justify-content-center mb-5" href="">

            <h1 class="text-secondary fw-bolder"><?php echo e(env('APP_NAME')); ?></h1>
        </a>

        <div class="mx-auto" style="max-width: 30rem;">
            <!-- Card -->
            <?php if(session()->has('message')): ?>
                <div class="alert alert-soft-danger" role="alert"><?php echo e(session('message')); ?></div>
            <?php endif; ?>

            <div class="card card-lg mb-5">
                <div class="card-body">
                    <!-- Form -->
                    <form class="js-validate needs-validation" method="post" action="<?php echo e(route('login.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="text-center">
                            <div class="mb-5">
                                <h1 class="display-5">Sign in</h1>
                            </div>
                        </div>

                        <!-- Form -->
                        <div class="mb-4">
                            <label class="form-label" for="email">Your email</label>
                            <input type="email" class="form-control form-control-lg" name="email" id="email" tabindex="1" placeholder="" aria-label="" required>
                            <span class="invalid-feedback">Please enter a valid email address.</span>
                        </div>
                        <!-- End Form -->

                        <!-- Form -->
                        <div class="mb-4">
                            <label class="form-label w-100" for="password" tabindex="0">
                                <span class="d-flex justify-content-between align-items-center">
                                    <span>Password</span>
                                </span> </label>

                            <div class="input-group input-group-merge" data-hs-validation-validate-class>
                                <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="password" placeholder="" aria-label="" data-hs-toggle-password-options='{"target": "#changePassTarget","defaultClass": "bi-eye-slash","showClass": "bi-eye","classChangeTarget": "#changePassIcon"}'>
                                <a id="changePassTarget" class="input-group-append input-group-text" href="javascript:;">
                                    <i id="changePassIcon" class="bi-eye"></i> </a>
                            </div>
                            <span class="invalid-feedback">Please enter a valid password.</span>
                        </div>
                        <!-- End Form -->

                        <!-- Form Check -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <!-- End Form Check -->

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
            <!-- End Card -->

        </div>
    </div>
    <!-- End Content -->
</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- JS Global Compulsory  -->
<script src="<?php echo e(getAsset('vendor/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(getAsset('vendor/jquery-migrate/dist/jquery-migrate.min.js')); ?>"></script>
<script src="<?php echo e(getAsset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>

<!-- JS Implementing Plugins -->
<script src="<?php echo e(getAsset('vendor/hs-toggle-password/dist/js/hs-toggle-password.js')); ?>"></script>

<!-- JS Front -->
<script src="<?php echo e(getAsset('js/theme.min.js')); ?>"></script>

<!-- JS Plugins Init. -->
<script>
    $(document).ready(function () {
        $('#email').val('hello@gmail.com');
        $('#password').val('this.hello');
    });
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\fit-fin-phy\resources\views/admin/authentication/login.blade.php ENDPATH**/ ?>