/////////////////////////////////////////////////////////////////////////////////////
// authentication service
/////////////////////////////////////////////////////////////////////////////////////
// app.factory('AuthenticationService', ['Base64', '$http', '$cookieStore', '$rootScope', '$timeout',
//     function (Base64, $http, $cookieStore, $rootScope, $timeout) {
//         let service = {};

//         service.Login = function (loginObj, callback) {
//         };

//         service.SetCredentials = function (loginRes) {
//             // var authdata = Base64.encode(loginObj.username.val + ':' + loginObj.password.val);

//             $rootScope.globals = {
//                 apiToken: loginRes.api_token,
//             };
//             $http.defaults.headers.common['Authorization'] = 'Bearer ' + loginRes.api_token; // jshint ignore:line
//             $cookieStore.put($rootScope.env.cookieName, $rootScope.globals);
//         };

//         service.ClearCredentials = function () {


//             $rootScope.globals = {};
//             $cookieStore.remove($rootScope.env.cookieName);
//         };

//         return service;
//     }]);

// app.factory('Base64', function () {
//     /* jshint ignore:start */
//
//     var keyStr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
//
//     return {
//         encode: function (input) {
//             var output = "";
//             var chr1, chr2, chr3 = "";
//             var enc1, enc2, enc3, enc4 = "";
//             var i = 0;
//
//             do {
//                 chr1 = input.charCodeAt(i++);
//                 chr2 = input.charCodeAt(i++);
//                 chr3 = input.charCodeAt(i++);
//
//                 enc1 = chr1 >> 2;
//                 enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
//                 enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
//                 enc4 = chr3 & 63;
//
//                 if (isNaN(chr2)) {
//                     enc3 = enc4 = 64;
//                 } else if (isNaN(chr3)) {
//                     enc4 = 64;
//                 }
//
//                 output = output +
//                     keyStr.charAt(enc1) +
//                     keyStr.charAt(enc2) +
//                     keyStr.charAt(enc3) +
//                     keyStr.charAt(enc4);
//                 chr1 = chr2 = chr3 = "";
//                 enc1 = enc2 = enc3 = enc4 = "";
//             } while (i < input.length);
//
//             return output;
//         },
//
//         decode: function (input) {
//             var output = "";
//             var chr1, chr2, chr3 = "";
//             var enc1, enc2, enc3, enc4 = "";
//             var i = 0;
//
//             // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
//             var base64test = /[^A-Za-z0-9\+\/\=]/g;
//             if (base64test.exec(input)) {
//                 window.alert("There were invalid base64 characters in the input text.\n" +
//                     "Valid base64 characters are A-Z, a-z, 0-9, '+', '/',and '='\n" +
//                     "Expect errors in decoding.");
//             }
//             input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
//
//             do {
//                 enc1 = keyStr.indexOf(input.charAt(i++));
//                 enc2 = keyStr.indexOf(input.charAt(i++));
//                 enc3 = keyStr.indexOf(input.charAt(i++));
//                 enc4 = keyStr.indexOf(input.charAt(i++));
//
//                 chr1 = (enc1 << 2) | (enc2 >> 4);
//                 chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
//                 chr3 = ((enc3 & 3) << 6) | enc4;
//
//                 output = output + String.fromCharCode(chr1);
//
//                 if (enc3 != 64) {
//                     output = output + String.fromCharCode(chr2);
//                 }
//                 if (enc4 != 64) {
//                     output = output + String.fromCharCode(chr3);
//                 }
//
//                 chr1 = chr2 = chr3 = "";
//                 enc1 = enc2 = enc3 = enc4 = "";
//
//             } while (i < input.length);
//
//             return output;
//         }
//     };
//
//     /* jshint ignore:end */
// });


/////////////////////////////////////////////////////////////////////////////////////
// pager service
/////////////////////////////////////////////////////////////////////////////////////
app.factory('PagerService', function() {
    // service definition
    var service = {};

    service.GetPager = GetPager;

    return service;

    // service implementation
    function GetPager(totalItems, currentPage, pageSize) {
        // default to first page
        currentPage = currentPage || 1;

        // default page size is 10
        pageSize = pageSize || 10;

        // calculate total pages
        var totalPages = Math.ceil(totalItems / pageSize);

        var startPage, endPage;
        if (totalPages <= 5) {
            // less than 10 total pages so show all
            startPage = 1;
            endPage = totalPages;
        } else {
            // more than 10 total pages so calculate start and end pages
            if (currentPage <= 3) {
                startPage = 1;
                endPage = 5;
            } else if (currentPage + 2 >= totalPages) {
                startPage = totalPages - 4;
                endPage = totalPages;
            } else {
                startPage = currentPage - 2;
                endPage = currentPage + 2;
            }
        }

        // calculate start and end item indexes
        var startIndex = (currentPage - 1) * pageSize;
        var endIndex = Math.min(startIndex + pageSize - 1, totalItems - 1);

        // create an array of pages to ng-repeat in the pager control
        var pages = [];
        for (var i = startPage; i <= endPage; i++) {
            pages.push(i);
        }
        // var pages = _.range(startPage, endPage + 1);

        // return object with all pager properties required by the view
        return {
            totalItems: totalItems,
            currentPage: currentPage,
            pageSize: pageSize,
            totalPages: totalPages,
            startPage: startPage,
            endPage: endPage,
            startIndex: startIndex,
            endIndex: endIndex,
            pages: pages,

        };
    }
});
