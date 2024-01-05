  <!-- JS Plugins Init. -->
<script>
    (function () {
        // INITIALIZATION OF NAVBAR VERTICAL ASIDE
        // =======================================================
        new HSSideNav('.js-navbar-vertical-aside').init();

        // INITIALIZATION OF FORM SEARCH
        // =======================================================
        new HSFormSearch('.js-form-search');

        // INITIALIZATION OF BOOTSTRAP DROPDOWN
        // =======================================================
        // HSBsDropdown.init();
        //
        // // INITIALIZATION OF SELECT
        // // =======================================================
        // HSCore.components.HSTomSelect.init('.js-select');

        // INITIALIZATION OF FLATPICKR
        // =======================================================
        // HSCore.components.HSFlatpickr.init('.js-flatpickr');

    })()
</script>



<script>
    (function () {
        // STYLE SWITCHER
        // =======================================================
        const $dropdownBtn = document.getElementById('selectThemeDropdown') // Dropdowon trigger
        const $variants = document.querySelectorAll(`[aria-labelledby="selectThemeDropdown"] [data-icon]`) // All items of the dropdown

        // Function to set active style in the dorpdown menu and set icon for dropdown trigger
        const setActiveStyle = function () {
            $variants.forEach($item => {
                if ($item.getAttribute('data-value') === HSThemeAppearance.getOriginalAppearance()) {
                    $dropdownBtn.innerHTML = `<i class="${$item.getAttribute('data-icon')}" />`
                    return $item.classList.add('active')
                }

                $item.classList.remove('active')
            })
        }

        // Add a click event to all items of the dropdown to set the style
        $variants.forEach(function ($item) {
            $item.addEventListener('click', function () {
                HSThemeAppearance.setAppearance($item.getAttribute('data-value'))
            })
        })

        // Call the setActiveStyle on load page
        setActiveStyle()

        // Add event listener on change style to call the setActiveStyle function
        window.addEventListener('on-hs-appearance-change', function () {
            setActiveStyle()
        })
    })()
</script>
<?php /**PATH C:\xampp\htdocs\fit-fin-phy\resources\views/admin/includes/footer-config-script.blade.php ENDPATH**/ ?>