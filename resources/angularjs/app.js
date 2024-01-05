// 'ngSanitize','psi.sortable', 'thatisuday.dropzone', 'ckeditor'
var app = angular.module('app', ['ngSanitize', 'textAngular']);

app.run(function($http, $rootScope) {
    // ENV
    $rootScope.isLoaderShow = false;
    $rootScope.env = {
        isHelpShow: true,
        showLog: true,
        serverErrorCallback: [5000, 419],
        pageSize: ['10','25','50','100'],
        isLiveSearch: true,
        FormSettings: {
            formInputSize: 'form-control-sm form-control-light form-select-light'
        },

    };
    // /ENV

    $rootScope.selectionObj = {
        isActive: [{id: 0, name: 'Inactive'}, {id: 1, name: 'Active'}],
        yesNo: [{id: 0, name: 'No'}, {id: 1, name: 'Yes'}],
        status: {options: [{id: 0, name: 'Inactive'}, {id: 1, name: 'Active'}], key: 'name', valueKey: 'id', label: null, isShowSearch: true},


    };




    // HELP ? //////////////////////////////////////////////////////

    // create data table fields //  inputType: date-range, text, number, text-editor, selection-search, selection-list | searchType: like, id, date-range


    // TABLE SEARCH
    // TABLE SEARCH FOREIGN KEY:- project_name: {label: 'Project', isSortable: 1, isSearchable: 1, isShowInTable: 1, isShowInTableChecked: 1,  displayType: 'text', className: 'avatar avatar-xs avatar-primary', inputType: 'selection-search', searchType: 'id', val: null, schemaName: 'Player', schemaColumn: 'id', select: {options: $rootScope.viewData.projects, key: 'name', valueKey: 'id', label: '- Select Project -', isShowSearch: true}},  |-> label also used null
    // TABLE SEARCH CATEGORY_NAME & CATEGORY_ID COLUMN:- project_name: {label: 'Project', isSortable: 1, isSearchable: 1, isShowInTable: 1, isShowInTableChecked: 1,  displayType: 'text', className: 'avatar avatar-xs avatar-primary', inputType: 'selection-search', searchType: 'id', val: null, schemaColumn: 'project_id', select: {options: $rootScope.viewData.projects, key: 'name', valueKey: 'id', label: '- Select Project -', isShowSearch: true}},  |-> label also used null

    // ALL INPUT
    // INPUT SELECTION SEARCH:- user_id: {val: null, label: 'Employee', type: 'selection-search', isRequired: 0, col: 4, select: {options: $rootScope.viewData.employees, key: 'name', valueKey: 'id', label: '- Select Employee -', isShowSearch: true}},  |-> label also used null
    // INPUT SELECTION LIST BASED:- task_priority_id: {val: '', label: 'Priority', type: 'selection-list', isRequired: 0, col: 4, select: {options: $rootScope.viewData.priority, key: 'name', valueKey: 'id', label: '- Select Priority -', isShowSearch: true}},  |-> label also used null
    // INPUT CHECKBOX:- select: {options: $rootScope.VerificationStatus, key: 'name', valueKey: 'id'}


    // SELECTION OPTION:- $rootScope.selectionObj['priority'] = {options: $rootScope.viewData.priority, key: 'name', valueKey: 'id', label: null, isShowSearch: false};


});
