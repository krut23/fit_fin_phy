app.controller('PageCtrl', function ($scope, $rootScope, $http, $log, form) {

    const dd = $rootScope.dataLog;

    $rootScope.titleS = '';
    $rootScope.titleP = '';
    $rootScope.viewData = {};

    $rootScope.pageSettingIsHide = {
        formCancel: true,

    };


    // Create form object
    $rootScope.newForm = () => {
        $rootScope.newFormOpenType('form', '6');
        $rootScope.thisForm = {
            'id': { val: 0, label: null, type: 'hidden', isRequired: 1, col: null },
            'data': { val: 1, label: 'Advertisement', type: 'selection-search', isRequired: 0, col: 3, select: $rootScope.selectionObj.ads},
        };
    };

    // Check validation and call storeData
    $scope.saveData = () => {
        $rootScope.thisForm = form.isValid($rootScope.thisForm);
        if ($rootScope.thisForm['formDescription']['isSubmit']) {
            $rootScope.storeData($rootScope.thisForm, $rootScope.routes.store, () => {location.reload();});
        }
    };

    $rootScope.setEditForm = (record) => {
        $scope.isAddModal = false;
        $rootScope.modalTitle = 'Edit ' + $rootScope.titleS;
        $rootScope.newForm();

        //
        // $index = helperServices.getIndex($rootScope.pager.filteredData, id);
        // if ($index < 0) {return;}

        let editRow = record;
        for (key in editRow) {
            if (key in $rootScope.thisForm) {
                if (['image', 'file'].includes($rootScope.thisForm[key]['type'])) {
                    $rootScope.thisForm[key]['temp'] = editRow[key];
                    $rootScope.thisForm[key]['isRequired'] = 0;
                } else if ($rootScope.thisForm[key]['type'].includes('date')) {
                    $rootScope.thisForm[key]['val'] = editRow[key] ? new Date(editRow[key]) : null;
                } else if ($rootScope.thisForm[key]['type'].includes('selection')) {
                    $rootScope.thisForm[key]['val'] = editRow[key] == null ? 'select' : editRow[key] + '';
                } else {
                    $rootScope.thisForm[key]['val'] = editRow[key];
                }

            }
        }
        // dd($rootScope.thisForm);
        $scope.addEditModelShow(1);
    };
    // Init call
    $rootScope.getViewData(() => {
        // Call Back...
        $rootScope.titleS = $rootScope.viewData.pageTitle.s;
        $rootScope.titleP = $rootScope.viewData.pageTitle.p;

        $rootScope.selectionObj['ads'] = { options: [{id: 'off', name: 'Off'}, {id: 'facebook', name: 'Facebook'}, {id: 'google', name: 'Google'}], key: 'name', valueKey: 'id', label: null, isShowSearch: false };

        $scope.record = $rootScope.viewData.record;

        $rootScope.setEditForm($scope.record);


    });

});
