app.controller('PageCtrl', function ($scope, $rootScope, $http, $log, form) {

    const dd = $rootScope.dataLog;

    $rootScope.titleS = '';
    $rootScope.titleP = '';
    $rootScope.viewData = {};
    $rootScope.dataTableFieldTotalColumn = 0;

    // page view settings is hide - 1: hide | 0: show
    $rootScope.pageSettingIsHide = {
        commonSearch: true,
        buttonCreateNew: true,
        rowFilters: false,
        columnAction: false,
        rowAction: true,
        isShowInTable: true

    }


    $rootScope.newDataTableFields = () => {
        $rootScope.dataTableFields = {
            id: {label: null, isSortable: 0, isSearchable: 0, isShowInTable: 0, isShowInTableChecked: 0,  displayType: 'badge', inputType: 'text', searchType: 'like', val: null},
            profile_url: {label: 'Image', isSortable: 0, isSearchable: 0, isShowInTable: 1, isShowInTableChecked: 1,  displayType: 'profile-image', inputType: 'text', val: null},
            name: {label: 'Name', isSortable: 1, isSearchable: 1, isShowInTable: 1, isShowInTableChecked: 1,  displayType: 'text', inputType: 'text', searchType: 'like', val: null},
            phone: {label: 'Phone', isSortable: 1, isSearchable: 1, isShowInTable: 1, isShowInTableChecked: 1,  displayType: 'text', inputType: 'text', searchType: 'like', val: null},
            email: {label: 'Email', isSortable: 1, isSearchable: 1, isShowInTable: 1, isShowInTableChecked: 1,  displayType: 'text', inputType: 'text', searchType: 'like', val: null},
            click: {label: 'Clicks', isSortable: 0, isSearchable: 0, isShowInTable: 1, isShowInTableChecked: 1,  displayType: 'clicks-redirect', inputType: 'text', searchType: 'like', val: null},
            is_active: {label: 'active', isSortable: 1, isSearchable: 1, isShowInTable: 1, isShowInTableChecked: 1, displayType: 'flip-btn-status', inputType: 'check-list', searchType: 'id', val: null, select: $rootScope.selectionObj.status, className: 'flip-btn-status', buttonColorActive: 'green'},
        }
    }






    $scope.saveData = () => {
        $rootScope.thisForm = form.isValid($rootScope.thisForm);
        if ($rootScope.thisForm['formDescription']['isSubmit']) {
            $rootScope.storeData($rootScope.thisForm, $rootScope.routes.store)
        }
    }

    // Init call
    $rootScope.getViewData(()=>{
        // Call Back...
        $rootScope.titleS = $rootScope.viewData.pageTitle.s;
        $rootScope.titleP = $rootScope.viewData.pageTitle.p;

        $rootScope.clicksRouts = $rootScope.viewData.clicksRouts || [];


        $rootScope.newDataTableFields();
        $rootScope.newTableFields();
        $rootScope.resetPage();
    });

});
