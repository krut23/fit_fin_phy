app.controller('PageCtrl', function ($scope, $rootScope, $http, $log, form, req) {

    const dd = $rootScope.dataLog;

    $rootScope.titleS = '';
    $rootScope.titleP = '';
    $rootScope.viewData = {};

    $rootScope.pageSettingIsHide = {
        formCancel: true,

    };
    // Create form object
    $rootScope.newForm = () => {
        $rootScope.newFormOpenType('form', '12');
        $rootScope.thisForm = {
            image: { val: null, label: 'Image', type: 'image', isRequired: 0, col: 6 },
            title: { val: null, label: 'Title', type: 'text', isRequired: 0, col: 6 },
            description: { val: null, label: 'Description', type: 'text', isRequired: 0, col: 12 },
        };
    };

    $scope.sendedNotification = [];

    $scope.uploadImage = () => {
        req.send({
            method: 'post',
            api: $rootScope.routes.storeImage,
            data: {image: $rootScope.thisForm.image.val,}
        }, res => {
            dd(res);
            $rootScope.thisForm.image.tempUrl = res.Data;
            $scope.sendNotification();
        });

    };


    $scope.sendNotification = () => {
        // $rootScope.isProcessing = true;
        for (i in $scope.customers) {
            const cust = $scope.customers[i];
            /*dd({
                        'notification': {
                            'body': $rootScope.thisForm.description.val,
                            'title': $rootScope.thisForm.title.val,
                            'image': $rootScope.thisForm.description.tempUrl,
                            'sound': 'default'
                        },
                        'to': cust.fcm_token
                     })*/
            if (cust.fcm_token) {
                $http({
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Authorization': $scope.cloudMessagingKey },
                    url: 'https://fcm.googleapis.com/fcm/send',
                    data: {
                        notification: {
                            body: $rootScope.thisForm.description.val,
                            title: $rootScope.thisForm.title.val,
                            image: $rootScope.thisForm.image.tempUrl,
                            sound: 'default'
                        },
                        to: cust.fcm_token
                    }
                }).then(response => {
                    const res = response.data;
                    $scope.sendedNotification.unshift({
                        id: cust.id,
                        name: cust.name,
                        isSuccess: res.success,
                        message: res.success ? 'Success' : 'Error',
                    });
                }).catch(error => {});
            } else {
                $scope.sendedNotification.unshift({
                    id: cust.id,
                    name: cust.name,
                    isSuccess: -1,
                    message: 'Invalid data',
                });
            }
            // dd($scope.sendedNotification);
        }

        $rootScope.isProcessing = false;
    };

    // Check validation and call storeData
    $scope.saveData = () => {
        $scope.uploadImage();
    };

    // Init call
    $rootScope.getViewData(() => {
        // Call Back...
        $rootScope.titleS = $rootScope.viewData.pageTitle.s;
        $rootScope.titleP = $rootScope.viewData.pageTitle.p;

        $scope.customers = $rootScope.viewData.customers;
        $scope.cloudMessagingKey = $rootScope.viewData.cloudMessagingKey;
        $rootScope.newForm();
        // $scope.addEditModelShow(1);
        // $rootScope.setEditForm({});

    });

});
