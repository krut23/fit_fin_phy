/////////////////////////////////////////////////////////////////////////////////////
// helper services
/////////////////////////////////////////////////////////////////////////////////////
app.service('helperServices', function() {

	this.getIndex = function(obj, val, key='id') {
   		return obj.findIndex((r) => { return r[key] === val});
	}

    this.slugify = function(string) {
   		if (!string) {return '';}
        let slug = string.toLowerCase().trim();
        slug = slug.replace(/[^a-z0-9\s-]/g, ' ');
        slug = slug.replace(/[\s-]+/g, '-');
        if (slug.charAt(slug.length - 1) === '-') {slug = slug.substring(0, slug.length - 1);}
        return slug;
	}

	// this.generateExcel = (tableID, filename = '') => {
    //     // Specify file name
    //     filename = filename ? filename + '.xls' : 'excel_data.xls';
    //     $('#'+tableID).table2excel({
    //         filename: filename
    //     });
    //
    // }

});


/////////////////////////////////////////////////////////////////////////////////////
// form services
/////////////////////////////////////////////////////////////////////////////////////

app.service('form', function() {

   	// Is valid
	this.isValid = (formObj) => {
		validation = [undefined, null,'select', '', '<p>Enter here...</p>\n'];
		index = 0;
		total = 0;
        formObj['formDescription'] = {isSubmit: false, formDataType: 'json'}; // formDataType: json,formData
		for (obj in formObj) {
            if (obj === 'formDescription') {
			    continue;
			}

            if (formObj[obj]['type'].includes('file')) {
                formObj['formDescription']['formDataType'] = 'formData';
            }

            if (formObj[obj]['comment'] === undefined) {
                formObj[obj]['comment'] = formObj[obj]['label']+' field is required.';
            }
            if (formObj[obj]['temp'] === undefined) {
                formObj[obj]['temp'] = null;
            }
            formObj[obj]['isValid'] = 0;
			if (formObj[obj]['isRequired']) {
				if (validation.includes(formObj[obj]['val'])) {
					// formObj[obj]['isValid'] = 0;
					formObj[obj]['msg'] = formObj[obj]['comment'];
				} else {
                    formObj[obj]['isValid'] = 1;
                    formObj[obj]['msg'] = null;
                    total ++;
				}
				index ++;
			}

		}
		formObj['formDescription']['isSubmit'] = index === total;
		// console.log(formObj);
		return formObj;
	}

    // Set not null
    // this.setNotNull = (formObj) => {
    //     validation = [undefined, null,'select', '', '<p>Enter description here...</p>\n'];
    //     for (obj in formObj) {
    //         if (validation.includes(formObj[obj]['val'])) {
    //             formObj[obj]['val'] = '';
    //         }
    //     }
    //     return formObj;
    // }

});


/////////////////////////////////////////////////////////////////////////////////////
// script services
/////////////////////////////////////////////////////////////////////////////////////

// app.service('script', function() {
// 	const secrateKey = '2&D@R.nM&qc?M{fK(3jvaP.%Hg,E&nf=RE_k3RW6]S=per6#!?';
// 	// encrypt string
// 	this.encrypt = (data) => {
// 		if (typeof(data) === 'object') {
// 			data = JSON.stringify(data);
// 		}
// 		return CryptoJS.AES.encrypt(data, secrateKey).toString();
// 	}
//
// 	// decrypt string
// 	this.decrypt = (data) => {
// 		data = CryptoJS.AES.decrypt(data, secrateKey).toString(CryptoJS.enc.Utf8)
// 		return JSON.parse(data);
// 	}
// });


/////////////////////////////////////////////////////////////////////////////////////
// local storage services
/////////////////////////////////////////////////////////////////////////////////////

// app.service('localStorage', function() {

// 	// set local data
// 	this.checkData = (key) => {
// 		return localStorage.getItem(key) === null;
// 	}

// 	// set local data
// 	this.setData = (data, key) => {
// 		localStorage.setItem(key, JSON.stringify(data));
// 		return localStorage.getItem(key) !== null;
// 	}

// 	// get local data
// 	this.getData = (key) => {
// 		if(localStorage.getItem(key) != null){
// 		   return JSON.parse(localStorage.getItem(key));
// 		} else {
// 			return null;
// 		}
// 	}

// 	// remove cookie data
// 	this.removeData = (key) => {
// 		localStorage.removeItem(key);
// 		return localStorage.getItem(key) === null;
// 	}
// });


/////////////////////////////////////////////////////////////////////////////////////
// cookie storage services
/////////////////////////////////////////////////////////////////////////////////////

// app.service('storage', function($cookies, script) {
// 	const cookieName  = 'admin-profile';
//
// 	// check is authenticate
// 	this.isAuthenticate = () => {
// 		return $cookies.get(cookieName) !== undefined;
// 	}
//
// 	// set cookie data
// 	this.setData = (data) => {
// 		data = script.encrypt(data);
// 		const cookieExp = new Date();
// 		cookieExp.setDate(cookieExp.getDate() + 1);
// 		$cookies.putObject(cookieName, data, { expires: cookieExp });
// 		return $cookies.get(cookieName) !== undefined;
// 	}
//
// 	// get cookie data
// 	this.getData = () => {
// 		data = JSON.parse($cookies.get(cookieName));
// 		return script.decrypt(data);
// 	}
//
// 	// remove cookie data
// 	this.removeData = () => {
// 		$cookies.remove(cookieName);
// 		return $cookies.get(cookieName) === undefined;
// 	}
// });


/////////////////////////////////////////////////////////////////////////////////////
// request services
/////////////////////////////////////////////////////////////////////////////////////

app.service('req', function($http, $rootScope, $location) {
    // Send request
	this.send = (requestObj, callback, isLoaderShow = true, reqAgainCount = 1) => {
		$rootScope.isLoaderShow = isLoaderShow;
		$http({
			method: requestObj.method,
			headers: requestObj.headers,
			url:requestObj.api,
			data: requestObj.data
		}).then(response => {
			$rootScope.isLoaderShow = false;
			callback(response.data);
		}).catch(error => {
			$rootScope.isLoaderShow = false;
			if (error.status === 401){
				$location.path('/login');
			}
            if (reqAgainCount > 0 && $rootScope.env.serverErrorCallback.includes(error.status)) {
                reqAgainCount -= 1;
                this.send(requestObj, callback, isLoaderShow, reqAgainCount);
            }
		});
	}



});

