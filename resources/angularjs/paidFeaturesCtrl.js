app.controller('PageCtrl', function ($scope, $rootScope, $http, $log, form) {

    const dd = $rootScope.dataLog;

    $rootScope.titleS = '';
    $rootScope.titleP = '';
    $rootScope.viewData = {};



    // Create form object
    $rootScope.newForm = () => {
        $rootScope.newFormOpenType('form', '12');
        $rootScope.thisForm = {
            'id': { val: 0, label: null, type: 'hidden', isRequired: 1, col: null },
            'expense': { val: 1, label: 'Expense', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            'income': { val: 1, label: 'Income', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            'bank': { val: 1, label: 'Bank', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            'goal': { val: 1, label: 'Goal', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            'budget': { val: 1, label: 'Budget', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            'reports': { val: 1, label: 'Reports', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            'water-remainder': { val: 1, label: 'Water Remainder', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            'sleep-remainder': { val: 1, label: 'Sleep Remainder', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            'medicine-reminder': { val: 1, label: 'Medicine Reminder', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            'heart-rate-monitor': { val: 1, label: 'Heart Rate Monitor', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            'task-manager': { val: 1, label: 'Task Manager', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            'habit-manager': { val: 1, label: 'Habit Manager', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            'step-counter': { val: 1, label: 'Step Counter', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            'calorie-and-distance': { val: 1, label: 'Guest Mode', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'Paid', off: 'Free' }, className: 'is-valid', isInline: false },
            // 'guest-mode': { val: 1, label: 'Guest Mode', type: 'switch', isRequired: 0, col: 3, switchLabel: { on: 'On', off: 'Off' }, className: 'is-valid', isInline: false },
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

        $scope.record = $rootScope.viewData.record.data;
        $scope.record.id = $rootScope.viewData.record.id;

        $rootScope.setEditForm($scope.record);


    });

});
