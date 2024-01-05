app.directive("ngFileread", [function () {
    return {
        restrict: 'A',
        scope: {
            ngFileread: "="
        },
        link: function (scope, element, attributes) {
            element.bind("change", function (changeEvent) {
                var reader = new FileReader();
                reader.onload = function (loadEvent) {
                    scope.$apply(function () {
                        scope.ngFileread = loadEvent.target.result;
                    });
                }
                reader.readAsDataURL(changeEvent.target.files[0]);
            });
        }
    }
}]);

app.directive('ngFile', ['$parse', function ($parse) {
    return {
       restrict: 'A',
       link: function(scope, element, attrs) {
          element.bind('change', function(){

          $parse(attrs.ngFile).assign(scope,element[0].files)
             scope.$apply();
          });
       }
    };
}]);


// poan number check
app.directive('panNumberCheck', function () {
        return {
            require: 'ngModel',
            link: function (scope, element, attrs, capitalizeModelCtrl) {

                var capitalizeInputText = function (inputText) {
                    var capitalizedValue = inputText ? inputText.toUpperCase().slice(0, 10) : inputText;

                    if (inputText === undefined || inputText === null) {
                        return inputText;
                    } else {
                        if (capitalizedValue !== inputText) {
                            capitalizeModelCtrl.$setViewValue(capitalizedValue);
                            capitalizeModelCtrl.$render();
                        }
                    }
                    return capitalizedValue;
                }

                capitalizeModelCtrl.$parsers.push(capitalizeInputText);
                capitalizeInputText(scope[attrs.ngModel]); //This is used to capitalize the initial value.
            }
        };
    });

// capital check
app.directive('capitalCheck', function () {
        return {
            require: 'ngModel',
            link: function (scope, element, attrs, capitalizeModelCtrl) {

                var capitalizeInputText = function (inputText) {
                    var capitalizedValue = inputText ? inputText.toUpperCase() : inputText;

                    if (inputText === undefined || inputText === null) {
                        return inputText;
                    } else {
                        if (capitalizedValue !== inputText) {
                            capitalizeModelCtrl.$setViewValue(capitalizedValue);
                            capitalizeModelCtrl.$render();
                        }
                    }
                    return capitalizedValue;
                }

                capitalizeModelCtrl.$parsers.push(capitalizeInputText);
                capitalizeInputText(scope[attrs.ngModel]); //This is used to capitalize the initial value.
            }
        };
    });



/**
 * Checklist-model
 * AngularJS directive for list of checkboxes
 */

angular.module('checklist-model', [])
    .directive('checklistModel', ['$parse', '$compile', function ($parse, $compile) {
        // contains
        function contains(arr, item) {
            if (angular.isArray(arr)) {
                for (var i = 0; i < arr.length; i++) {
                    if (angular.equals(arr[i], item)) {
                        return true;
                    }
                }
            }
            return false;
        }

        // add
        function add(arr, item) {
            arr = angular.isArray(arr) ? arr : [];
            for (var i = 0; i < arr.length; i++) {
                if (angular.equals(arr[i], item)) {
                    return arr;
                }
            }
            arr.push(item);
            return arr;
        }

        // remove
        function remove(arr, item) {
            if (angular.isArray(arr)) {
                for (var i = 0; i < arr.length; i++) {
                    if (angular.equals(arr[i], item)) {
                        arr.splice(i, 1);
                        break;
                    }
                }
            }
            return arr;
        }

        // http://stackoverflow.com/a/19228302/1458162
        function postLinkFn(scope, elem, attrs) {
            // compile with `ng-model` pointing to `checked`
            $compile(elem)(scope);

            // getter / setter for original model
            var getter = $parse(attrs.checklistModel);
            var setter = getter.assign;

            // value added to list
            var value = $parse(attrs.checklistValue)(scope.$parent);

            // watch UI checked change
            scope.$watch('checked', function (newValue, oldValue) {
                if (newValue === oldValue) {
                    return;
                }
                var current = getter(scope.$parent);
                if (newValue === true) {
                    setter(scope.$parent, add(current, value));
                } else {
                    setter(scope.$parent, remove(current, value));
                }
            });

            // watch original model change
            scope.$parent.$watch(attrs.checklistModel, function (newArr, oldArr) {
                scope.checked = contains(newArr, value);
            }, true);
        }

        return {
            restrict: 'A',
            priority: 1000,
            terminal: true,
            scope: true,
            compile: function (tElement, tAttrs) {
                if (tElement[0].tagName !== 'INPUT' || !tElement.attr('type', 'checkbox')) {
                    throw 'checklist-model should be applied to `input[type="checkbox"]`.';
                }

                if (!tAttrs.checklistValue) {
                    throw 'You should provide `checklist-value`.';
                }

                // exclude recursion
                tElement.removeAttr('checklist-model');

                // local scope var storing individual checkbox model
                tElement.attr('ng-model', 'checked');

                return postLinkFn;
            }
        };
    }]);

app.directive('setFocus', function () {
    return {
        link: function (scope, element, attrs) {
            element.bind('click', function () {
                //alert(element.attr('id'));
                document.querySelector('#' + attrs.setFocus).focus();
            })
        }
    }
})
