app.controller("rootCtrl", function ($scope, $rootScope, $http, $log,$timeout, helperServices, req, form, PagerService) {

    // Helpers ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    $rootScope.dataLog = (data,debug = false) => {
        if($rootScope.env.showLog) {
            $log.info(data);
            if (debug) {debugger;}
        }
    }

    const dd = $rootScope.dataLog;

    // var declare
    $rootScope.isSidebar = false;
    $rootScope.isShowTableLoader = false;
    $rootScope.isDetailsForm = false;

    // Get all route from view
    $rootScope.getViewData = (cb = null) => {
        $rootScope.viewData = JSON.parse($('#encodedViewData').val());
        dd($rootScope.viewData);
        $rootScope.routes = $rootScope.viewData.routes;

        $rootScope.isAdmin = $('#isAdminViewData').val() == 1;

        if (cb){cb()}
    }

    // form related------------------------------------------------------------------------------
    // Total table column count
    $scope.$watch('dataTableFields', function() {
        // alert('hey, myVar has changed!');
        $rootScope.dataTableFieldTotalColumn = 0;
        if (!$rootScope.dataTableFields) {return '';}
        for (key in $rootScope.dataTableFields) {$rootScope.dataTableFieldTotalColumn += $rootScope.dataTableFields[key]['isShowInTableChecked'];}
    });


    // Reset form
    $rootScope.formReset = (idOrClass = '.all-form-reset') => {
        // $('.add-edit-form').trigger('reset');
        $rootScope.deleteFileList = [];
        $rootScope.slugBox = undefined;
        $(idOrClass+' input[type="file"]').val('');
    }

    // Format Date
    $rootScope.formatDate = (date) =>{
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }

    // Form type (modal, form)
    $rootScope.newFormOpenType = (type = 'modal', size = null) => {
        $rootScope.formOpenType = {
            type: type, //form
            size: size,
        };
    }

    // Modal Show Hide
    $scope.addEditModelShow = (isShow, id = '#add_edit_model') => {
        if (!isShow){$rootScope.formReset()}
        isShow = (isShow) ? 'show' : 'hide';
        if ($rootScope.formOpenType.type !== 'form') {$(id).modal(isShow)}

    }

    // Delete file List
    $rootScope.deleteFileList = [];
    $rootScope.addDeleteFileList = (fileKey, isDelete = 0) => {
        if (fileKey) {
            // let fileList = $rootScope.thisForm.formDescription.deleteFileList;
            if (isDelete && !$rootScope.deleteFileList.includes(fileKey)) {
                $rootScope.deleteFileList.push(fileKey);
            }
            if (!isDelete) {
                const index = $rootScope.deleteFileList.indexOf(fileKey);
                if (index !== -1) {
                    $rootScope.deleteFileList.splice($rootScope.deleteFileList, 1);
                }
            }
        }
    }

    // Set slug box
    $rootScope.setSlugBox = (value) => {
        $rootScope.thisForm.slug.val = helperServices.slugify(value);
        // $('.slug-box-model').val(slug);
    }

    // Set Latitude Longitude Box
    $rootScope.setLatitudeLongitudeBox = (value, latLongIndex) => {
        value = value.split(',');
        if (value.length !== 2){ return;}
        $rootScope.thisForm.latitude.val = value[0];
        $rootScope.thisForm.longitude.val = value[1];
    }

    // Set meta box
    $rootScope.setMetaBox = () => {
        $rootScope.thisForm.itemprop_name.val = $rootScope.thisForm.meta_title.val;
        $rootScope.thisForm.og_title.val = $rootScope.thisForm.meta_title.val;
        $rootScope.thisForm.twitter_title.val = $rootScope.thisForm.meta_title.val;

        $rootScope.thisForm.itemprop_description.val = $rootScope.thisForm.meta_description.val;
        $rootScope.thisForm.og_description.val = $rootScope.thisForm.meta_description.val;
        $rootScope.thisForm.twitter_description.val = $rootScope.thisForm.meta_description.val;

        $rootScope.thisForm.itemprop_keywords.val = $rootScope.thisForm.meta_keywords.val;

        $rootScope.thisForm.og_url.val = $rootScope.thisForm.itemprop_url.val;
    }

    // other------------------------------------------------------------------------------


    // Show image preview
    $rootScope.showImagePreview = (imageUrl = null) => {
        $rootScope.imagePreviewUrl = imageUrl;
    }
    // Show hide sidebar
    $scope.sidebarEvent = () => {
        $rootScope.isSidebar = !$rootScope.isSidebar;
    }


    // Toaster ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    (() => {
        toastr.options.positionClass = "toast-top-right";
        toastr.options.closeButton = true;
        toastr.options.showMethod = 'slideDown';
        toastr.options.hideMethod = 'slideUp';
        //toastr.options.newestOnTop = false;
        toastr.options.progressBar = true;
    })();
    $scope.makeToast = (status, message = '') => {
        switch (status) {
            case 'success':
                toastr.success(message);
                break;
            case 'error':
                toastr.error(message);
                break;
            case 'warning':
                toastr.warning(message);
                break;
            case 'info':
                toastr.info(message);
                break;
            default:
                toastr.clear();
        }
    }

    const showToaster = (response) => {
        if (response.IsSuccess) {
            $scope.makeToast('success',response.Message);
        } else {
            $scope.makeToast('error',response.Message);
        }
    }
    $rootScope.showToaster = showToaster;

    // Pagination ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    $rootScope.pager = {
        isCount: true,
        totalItems: null,
        currentPage: null,
        pageSize: '10',
        totalPages: '1',
        startPage: null,
        endPage: null,
        startIndex: 0,
        endIndex: null,
        pages: null,
        filteredData: {},
        isBrowse: 0,
        // message: null,
        searchParams: {
            // name: null,
            short_order : {
                column_name: 'id',
                shorting_order: 'DESC'
            }
        },
        dataTableFields: {},
        dataTableCommonSearch: null,
        isAllRecords: false
    };
    // Reset page
    $rootScope.resetPage = () => {
        $rootScope.isShowTableLoader = true;
        $rootScope.pager.startIndex = 0;
        $rootScope.getDataListCount();
    }

    // Reset page
    $rootScope.viewAllRecords = (isAll = 1) => {
        $rootScope.pager.isAllRecords = isAll;
        $rootScope.resetPage();
    }

    // Set page number
    $rootScope.setPage = (page, isFirst= false) => {
        if (page < 1 || page > $rootScope.pager.totalPages) {return;}
        const tempPager = $rootScope.pager;

        $rootScope.pager = PagerService.GetPager($rootScope.pager.totalItems, page, parseInt($rootScope.pager.pageSize), $rootScope.pager);
        $rootScope.pager.pageSize = $rootScope.pager.pageSize.toString();
        $rootScope.pager['isCount'] = tempPager.isCount;
        $rootScope.pager['filteredData'] = tempPager.filteredData;
        $rootScope.pager['isBrowse'] = tempPager.isBrowse;
        $rootScope.pager['searchParams'] = tempPager.searchParams;
        $rootScope.pager['isAllRecords'] = tempPager.isAllRecords;
        $rootScope.pager['dataTableFields'] = tempPager.dataTableFields;
        $rootScope.pager['dataTableCommonSearch'] = tempPager.dataTableCommonSearch;

        if (!isFirst) {$rootScope.getDataListCount(false);}

    }

    // Apply search
    $rootScope.runSearch = (searchType = null, isSearch = 0) => {
        if ($rootScope.env.isLiveSearch || isSearch) {
            if (searchType === 'common') {
                $rootScope.resetSearch();
            } else {
                $rootScope.pager.dataTableCommonSearch = null;
                $rootScope.resetPage();
            }
        }
    }

    // Get data list or count
    $rootScope.getDataListCount = (isCount= true) => {
        $rootScope.pager.isCount = isCount;
        $rootScope.pager.filteredData = null;
        $rootScope.pager.dataTableFields = $rootScope.dataTableFields;
        req.send({
            method: 'post',
            api: $rootScope.routes.show,
            data: $rootScope.pager
        }, response => {
            dd(response);
            $rootScope.pager.filteredData = response.Data.filteredData;
            if (isCount) {
                $rootScope.pager.totalItems = response.Data.totalRecords;
                if ($rootScope.pager.totalItems > 0) {
                    $rootScope.setPage(1, isCount);
                }
            }
            $rootScope.isShowTableLoader = false;
        }, false);
    }

    // Get details (single row)
    $rootScope.getDataDetails = (cb = null) => {
        req.send({
            method: 'post',
            api: $rootScope.routes.details,
            data: {}
        }, response => {
            dd(response);
            if (response.IsSuccess) {
                $rootScope.dataDetails = response.Data;
                if (cb) {cb()}
            }
            $rootScope.isShowTableLoader = false;

        }, false);
    }

    // Short data list
    $rootScope.currentShortingColumn = 'id';
    $rootScope.currentShortingOrderIcon = 'ASC';

    $rootScope.setShort = (column_name = 'id') => {
        let shortingOrder = $rootScope.pager.searchParams.short_order.shorting_order;
        if(shortingOrder === 'DESC') {
            shortingOrder = 'ASC';
        }else if (shortingOrder === 'ASC') {
            shortingOrder = 'DESC';
        } else {
            shortingOrder = 'ASC';
        }

        $rootScope.currentShortingColumn = column_name;
        $rootScope.pager.searchParams.short_order.column_name = column_name;
        $rootScope.pager.searchParams.short_order.shorting_order = shortingOrder;
        $rootScope.currentShortingOrderIcon = shortingOrder+'_'+column_name;

        $rootScope.resetPage();
    };

    // Reset search
    $rootScope.resetSearch = () => {
        for (row in $rootScope.dataTableFields) {
            if($rootScope.dataTableFields[row]['searchType'] === 'date-range') {
                $rootScope.dataTableFields[row]['val'] = {from: null, to: null};
            } else if ($rootScope.dataTableFields[row]['inputType'] === 'selection-search') {
                $rootScope.dataTableFields[row]['select']['label'] = '';
                $rootScope.dataTableFields[row]['val'] = '';
            } else {
                $rootScope.dataTableFields[row]['val'] = '';
            }
        }
        $rootScope.resetPage();
    }


    // CRUD Operation ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    $scope.isAddModal = true;

    // Open add form
    $rootScope.addForm = () => {
        $scope.isAddModal = true;
        $rootScope.modalTitle = 'Add ' + $rootScope.titleS;
        $rootScope.newForm();
        $scope.addEditModelShow(1);
    }

    // Create form data object
    const createFormData = (formData) => {
        newFormData = new FormData();
        for (obj in formData) {
            if (obj === 'formDescription') {
                delete formData[obj];
            }/* else if (formData[obj]['type'] === 'line') {
                delete formData[obj];
            } */else if(formData[obj]['val'] !== undefined) {
                if(formData[obj]['type'].includes('file')) {
                    angular.forEach(formData[obj]['val'],function(file){
                        newFormData.append(obj+'[]',file);
                    });
                } else {
                    if (formData[obj]['val'] === 'select') {
                        formData[obj]['val'] = null;
                    }
                    if (formData[obj]['type'] === 'date') {
                        $dateValue = formData[obj]['val'] ? $rootScope.formatDate(formData[obj]['val']) : null;
                        newFormData.append(obj,$dateValue);
                    } else if (formData[obj]['type'] === 'time') {
                        newFormData.append(obj,moment(formData[obj]['val'],'h:mm:ss A').format('H:mm'));
                    } else {
                        newFormData.append(obj,formData[obj]['val']);
                    }
                }
            }else {
                newFormData.append(obj,formData[obj]);
            }
        }
        if ($rootScope.deleteFileList) {
            newFormData.append('deleteFileList',JSON.stringify($rootScope.deleteFileList));
        }
        return newFormData;

    }

    // Create json data object
    const createJsonData = (formData) => {
        newFormData = {};
        for (obj in formData) {
            if (obj === 'formDescription') {
                delete formData[obj];
            }/* else if (formData[obj]['type'] === 'line') {
                delete formData[obj];
            } */else if(formData[obj]['val'] !== undefined) {
                if (formData[obj]['val'] === 'select') {
                    formData[obj]['val'] = null;
                }
                if (formData[obj]['type'] === 'date') {
                    $dateValue = formData[obj]['val'] ? $rootScope.formatDate(formData[obj]['val']) : null;
                    newFormData[obj] = $dateValue;
                } else if (formData[obj]['type'] === 'time') {
                    newFormData[obj] = moment(formData[obj]['val'],'h:mm:ss A').format('H:mm');
                    // $filter('date')(date, format, timezone)
                } else {
                    newFormData[obj] = formData[obj]['val'];
                }

            } else {
                newFormData[obj] = formData[obj];
            }
        }
        if ($rootScope.deleteFileList) {
            newFormData['deleteFileList'] = $rootScope.deleteFileList;
        }
        return newFormData;
    }

    // Send request for store data
    $rootScope.storeData = (formData, route, cb = null, cbFinally = null) => {
        // newFormData = {};
        let headers = {};
        if (formData['formDescription']['formDataType'] === 'formData') {
            newFormData = createFormData(formData);
            headers['Content-Type'] = undefined;
        } else {
            newFormData = createJsonData(formData);
        }
        dd(newFormData);
        req.send({
            headers: headers,
            method: 'post',
            api: route,
            data: newFormData
        }, response => {
            dd(response);
            if (cbFinally) {
                $rootScope.response = response;
                $rootScope.showToaster = showToaster;
                cbFinally();
            } else {
                showToaster(response);
                if (response.IsSuccess) {
                    $scope.addEditModelShow(0);
                    $rootScope.newFormOpenType();
                    if (cb) {
                        cb()
                    } else {
                        $rootScope.resetPage();
                    }
                    // location.reload();
                }
            }
        });
    }

    // Meta information
    $rootScope.newFormMeta = () => {
        $rootScope.formOpenType = {
            type: 'form',
            size: null,
        };


        $rootScope.thisForm = {
            id: {val: 0, label: null, type: 'hidden', isRequired: 1, col: null},
            is_meta: {val: 1, label: null, type: 'hidden', isRequired: 0, col: null},
            meta_title: {val: null, label: 'Title ( Max 60 characters allowed)', type: 'meta', isRequired: 0, col: 4, rows: 3, lan: 60},
            meta_description: {val: null, label: 'Description ( Max 160 characters allowed)', type: 'meta', isRequired: 0, col: 4, rows: 3, lan: 160},
            meta_keywords: {val: null, label: 'Keywords ( Max 160 characters allowed)', type: 'meta', isRequired: 0, col: 4, rows: 3, lan: 160},
            itemprop_name: {val: null, label: 'Itemprop Name ( Max 60 characters allowed)', type: 'meta', isRequired: 0, col: 4, rows: 3, lan: 60, isReadOnly: 1},
            itemprop_description: {val: null, label: 'Itemprop Description ( Max 160 characters allowed)', type: 'meta', isRequired: 0, col: 4, rows: 3, lan: 160, isReadOnly: 1},
            itemprop_keywords: {val: null, label: 'Itemprop Keywords ( Max 160 characters allowed)', type: 'meta', isRequired: 0, col: 4, rows: 3, lan: 160, isReadOnly: 1},
            og_title: {val: null, label: 'Og Title ( Max 60 characters allowed)', type: 'meta', isRequired: 0, col: 4, rows: 3, lan: 60, isReadOnly: 1},
            og_description: {val: null, label: 'Og Description ( Max 160 characters allowed)', type: 'meta', isRequired: 0, col: 4, rows: 3, lan: 160, isReadOnly: 1},
            itemprop_url: {val: null, label: 'Itemprop Url', type: 'meta', isRequired: 0, col: 4, rows: 3},
            twitter_title: {val: null, label: 'Twitter Title', type: 'meta', isRequired: 0, col: 4, rows: 3, lan: 60, isReadOnly: 1},
            twitter_description: {val: null, label: 'Twitter Description', type: 'meta', isRequired: 0, col: 4, rows: 3, lan: 160, isReadOnly: 1},
            og_url: {val: null, label: 'Og Url', type: 'meta', isRequired: 0, col: 4, rows: 3, isReadOnly: 1},
            twitter_card: {val: null, label: 'Twitter Card', type: 'text', isRequired: 0, col: 4, rows: 3},
            twitter_site: {val: null, label: 'Twitter Site', type: 'text', isRequired: 0, col: 4, rows: 3},
            og_image: {val: null, label: 'Og Image', type: 'image', isRequired: 0, col: 4, isDelete: 1},
            twitter_image: {val: null, label: 'Twitter Image', type: 'image', isRequired: 0, col: 4, rows: 3, isDelete: 1},
        };
    }

    // Set Edit Form
    $rootScope.setEditForm = (id, isMeta = 0, cb = null) => {
        $scope.isAddModal = false;
        $rootScope.modalTitle = 'Edit ' + $rootScope.titleS;
        $rootScope.newForm();

        if (isMeta) {
            $rootScope.modalTitle = 'Edit Meta';
            $rootScope.newFormMeta();
        }
        $index = helperServices.getIndex($rootScope.pager.filteredData, id);
        if ($index < 0) {return;}

        let editRow = $rootScope.pager.filteredData[$index];
        for (key in editRow) {
            if (key in $rootScope.thisForm) {
                if (['image','file'].includes($rootScope.thisForm[key]['type'])) {
                    $rootScope.thisForm[key]['temp'] = editRow[key];
                    $rootScope.thisForm[key]['isRequired'] = 0;
                } else if ($rootScope.thisForm[key]['type'].includes('date')) {
                    $rootScope.thisForm[key]['val'] = editRow[key] ? new Date(editRow[key]) : null;
                } else if ($rootScope.thisForm[key]['type'].includes('selection')) {
                    $rootScope.thisForm[key]['val'] = editRow[key] == null ? 'select' : editRow[key]+'';
                } else {
                    $rootScope.thisForm[key]['val'] = editRow[key];
                }


                if($rootScope.thisForm[key]['valueType'] === 'redirect-text') {
                    $rootScope.thisForm[key]['val'] = $rootScope.thisForm[key]['val']['label'] || $rootScope.thisForm[key]['val'];
                }
                // if ($rootScope.ThisForm[key]['type'].includes('selection')) {
                //     $rootScope.ThisForm[key]['val'] = editRow[key] ? editRow[key].toString() : 'selection';
                // }

                // if ($rootScope.thisForm[key]['isRequiredEdit']) {
                //     $rootScope.thisForm[key]['val'] = editRow[key] ? new Date(editRow[key]) : null;
                // }
            }
        }
        // dd($rootScope.thisForm);
        if (cb) {cb()}
        $scope.addEditModelShow(1);
    }

    // check slug availability
    $rootScope.checkSlugAvailability = () => {
        id = $rootScope.thisForm.id.val;
        slug = $rootScope.thisForm.slug.val;
        req.send({
            method: 'post',
            api: $rootScope.routes.checkSlug,
            data: {id: id, slug: slug}
        }, response => {
            dd(response);
            if (response.IsSuccess) {
                $rootScope.slugAvailabilityMessage = null;
            } else {
                $rootScope.slugAvailabilityMessage = response.Message;
            }
        });
    }

    // Send Request for Change Status
    $rootScope.changeStatus = (id, route = null, isReset = 0) => {
        if (route === null ) {route = $rootScope.routes.update}
        req.send({
            method: 'post',
            api: route,
            data: {id: id, status_change: true}
        }, response => {
            dd(response);
            showToaster(response);
            if (response.IsSuccess && isReset) {
                $rootScope.resetPage();
            }
            if (!response.IsSuccess) {
                $rootScope.resetPage();
            }
        });

    }

    // Send Request for Delete Data
    $rootScope.deleteData = (id, route = null, cb = null) => {
        if (route === null ) {route = $rootScope.routes.destroy}
        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            dangerMode: true,
            buttons: ['No, cancel!', 'Yes, delete it!'],
            // className: {
            //     confirmButton: 'btn btn-danger me-2',
            //     denyButton: 'btn btn-secondary'
            // },
            buttonsStyling: false
        }).then((isConfirmed) => {
            if (isConfirmed) {
                req.send({
                    method: 'post',
                    api: route,
                    data: {id: id}
                }, response => {
                    dd(response);
                    showToaster(response);
                    if (response.IsSuccess) {
                        if (cb) {
                            cb()
                        } else {
                            $rootScope.resetPage();
                        }
                        $scope.addEditModelShow(0);
                    }
                });
            }
        });
    }

// File Manager ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    // File uploader reverce click
    // $rootScope.preventClickingFile = () => {
    //     $('.prevent-clicking-file').click(function(e) {
    //         e.preventDefault();
    //     });
    // }

    $rootScope.openFileManager = (formFilters) => {
        $rootScope.$rootScope(formFilters);
        // $rootScope.resetPageDropzone();
    }

    $rootScope.dropzoneOptions = {};
    $rootScope.openFileManager = (dropzoneOptions) => {
        $rootScope.isDropzoneInit = true;
        $rootScope.dropzoneOptions = dropzoneOptions;
        $rootScope.isDropzoneUploade = false;
        $scope.isShowTableLoaderDropzone = false;
        $scope.dzOptions = {
            headers: {'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')},
            url : dropzoneOptions.routes.store,
            init: function() {
                this.on('sending', function(file, xhr, formData) {
                    for (obj in dropzoneOptions.uploadFormData) {
                        formData.append(obj, dropzoneOptions.uploadFormData[obj]);
                    }
                });
            },
            paramName : dropzoneOptions.paramName,
            maxFilesize : dropzoneOptions.maxFilesize,
            acceptedFiles : dropzoneOptions.acceptedFiles,
            addRemoveLinks : true,
            maxFiles : dropzoneOptions.maxFiles
        };

        $scope.myDz = null;
        $scope.dzMethods = {};


        // setting callbacks
        $scope.dzCallbacks = {
            'addedfile' : function(file){
                if(file.isMock){
                    $scope.myDz.createThumbnailFromUrl(file, file.serverImgUrl, null, true);
                }
            }
        }
        // $rootScope.getDataListDropzone(dropzoneOptions.formFilters);
        $rootScope.getDataListDropzone();

        $('#file_manager_model').modal('show');


    };

    // Reset page
    // $rootScope.resetPageDropzone = () => {
    //     $scope.isShowTableLoaderDropzone = true;
        // $scope.getDataListCountDropzone();
    // }

    // Send Request for Delete Data
    $rootScope.deleteFileManagerFile = (id, route = null) => {
        if (route === null) {route = $rootScope.dropzoneOptions.routes.destroy}
        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            dangerMode: true,
            buttons: ['No, cancel!', 'Yes, delete it!'],
            // className: {
            //     confirmButton: 'btn btn-danger me-2',
            //     denyButton: 'btn btn-secondary'
            // },
            buttonsStyling: false
        }).then((isConfirmed) => {
            if (isConfirmed) {
                req.send({
                    method: 'post',
                    api: route,
                    data: {id: id}
                }, response => {
                    dd(response);
                    showToaster(response);
                    if (response.IsSuccess) {
                        $rootScope.getDataListDropzone();
                    }
                });
            }
        });
    }
    // Get data list or count
    $rootScope.getDataListDropzone = () => {
        $rootScope.fileManagerData = null;
        req.send({
            method: 'post',
            api: $rootScope.dropzoneOptions.routes.show,
            data: $rootScope.dropzoneOptions.formFilters
        }, response => {
            $rootScope.fileManagerData = response.Data;
            dd($rootScope.fileManagerData);
            $scope.isShowTableLoaderDropzone = false;
        }, false);
    }


//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    $rootScope.selectUl = () => {

        $(document).mouseup(function(e) {
            var container = $('.select-ul ul');
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.hide();
            }

        });

        $('.select-ul').click(function() {$(this).children('ul').show();});

        // $('.select-ul .option').click(function() {$('.select-ul ul').hide();});

        $('body').on('click','.select-ul ul li.option',function(e) {
            e.stopPropagation();
            $(this).parents('ul').hide();
        });


        $('.select-ul input').click(function() {this.select();});

    }

    // $rootScope.selectUlClose = () => {
    //     $('.select-ul').click(function() {$(this).children('ul').show();});
    // }
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    // Init
    $rootScope.newFormOpenType();
    // remove body display none class after load angular js
    $( document ).ready(function() {
        $('.main-content-body').removeClass('d-none');
    });

});
