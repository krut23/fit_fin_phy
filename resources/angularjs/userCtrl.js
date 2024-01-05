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

    // create table row action button
    // $rootScope.tableRowActionButton = {
    //     edit: {isShow: 1},
    //     delete: {isShow: 1},
    // }

    // statusField
    // create data modal fields for status
    // $rootScope.statusField = {
    //     is_active: {status: 'is-active'}
    // }

    // create data table fields //  inputType: date-range, text, number, | searchType: like, id, date-range


    $rootScope.newDataTableFields = () => {
        $rootScope.dataTableFields = {
            id: {label: null, isSortable: 0, isSearchable: 0, isShowInTable: 0, isShowInTableChecked: 0,  displayType: 'badge', inputType: 'text', searchType: 'like', val: null},
            profile_url: {label: 'Image', isSortable: 0, isSearchable: 0, isShowInTable: 1, isShowInTableChecked: 1,  displayType: 'profile-image', inputType: 'text', val: null},
            name: {label: 'Name', isSortable: 1, isSearchable: 1, isShowInTable: 1, isShowInTableChecked: 1,  displayType: 'text', inputType: 'text', searchType: 'like', val: null},
            phone: {label: 'Phone', isSortable: 1, isSearchable: 1, isShowInTable: 1, isShowInTableChecked: 1,  displayType: 'text', inputType: 'text', searchType: 'like', val: null},
            email: {label: 'Email', isSortable: 1, isSearchable: 1, isShowInTable: 1, isShowInTableChecked: 1,  displayType: 'text', inputType: 'text', searchType: 'like', val: null},
            click: {label: 'Clicks', isSortable: 0, isSearchable: 0, isShowInTable: 1, isShowInTableChecked: 1,  displayType: 'clicks-redirect', inputType: 'text', searchType: 'like', val: null},
            is_active: {label: 'Status', isSortable: 1, isSearchable: 1, isShowInTable: 1, isShowInTableChecked: 1, displayType: 'flip-btn-status', inputType: 'check-list', searchType: 'id', val: null, select: $rootScope.selectionObj.status, className: 'flip-btn-status', buttonColorActive: 'green'},
        }
    }

    // Create form object
    $rootScope.newForm = () => {
        // $rootScope.newFormOpenType('form', '12');
        $rootScope.thisForm = {
            // id: {val: 0, label: null, type: 'hidden', isRequired: 1, col: null},
            // name: {val: null, label: 'Name', type: 'text', isRequired: 1, col: 12, valueType: 'redirect-text'},
            // email: {val: null, label: 'Email', type: 'text', isRequired: 1, col: 12},
            // phone: {val: null, label: 'Phone', type: 'text', isRequired: 1, col: 12},
            // address: {val: null, label: 'Address', type: 'description', isRequired: 0, col: 12},
            // password: {val: null, label: 'Password', type: 'text', isRequired: 0, col: 12},
            // is_active: {val: 1, label: 'Status', type: 'switch', isRequired: 0, col: 6, switchLabel: {on: 'Active', off: 'Inactive'}, className: 'is-valid', isInline: false},

        };
    }
    // Check validation and call storeData

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
        $rootScope.resetPage();
    });

});


