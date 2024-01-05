<?php
// Project Helpers |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('filterPhone')) {
    function filterPhone($phone){
        if(empty($phone)) return null;
        $phone = preg_replace('/[+.() \-]/i', '', $phone);
        $phone = preg_replace('!\s+!', ' ', $phone);
        $phone = preg_replace('/^91/', '', $phone);
        return trim($phone);
    }
}
if (!function_exists('filterName')) {
    function filterName($name){
        if(empty($name)) return null;
        $name = preg_replace('/[^a-zA-Z0-9\']/', ' ', strtolower($name));
        $name = preg_replace('!\s+!', ' ', $name);
        return trim($name);
    }
}






// Data helpers |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
// check and get value
if (!function_exists('getValue')) {
    function getValue($obj, $key, $defaultType = 'n', $defaultValue = 0){
        // s: string '', d: date null, n: null, t: tiny int status, custom
//        dd((!empty($obj[$key]) && $obj[$key] != 'null'));
        if ($defaultType == 't') {
            $val = array_key_exists($key, $obj) ? $obj[$key] : $defaultValue;
            return in_array($val,['true', true, '1', 1]) ? 1 : 0;
        }

        $dataType = ['s' => '', 'd' => null, 'n' => null];
        $default = array_key_exists($defaultType, $dataType) ? $dataType[$defaultType] : $defaultType;
        return (!empty($obj[$key]) && $obj[$key] != 'null') ? $obj[$key] : $default;
    }
}
//if (!function_exists('getRowValue')) {
//    function getRowValue($row, $keys, $methodLabel = null){
//        $keys = explode('.', $keys);
//        $val = '';
////        dd($row);
//        foreach ($keys as $key) {
//            if (!$row && array_key_exists($key, $row) && !in_array($row[$key], [0 , 1, '0', '1']) ) {
//                return '';
//            }
//            $row = $row[$key];
//        }
//        return $row ? $row : '';
//    }
//}

/// //if (!function_exists('getValueStatus')) {
//    function getValueStatus($obj, $key, $defaultValue = 0){
//        $val = array_key_exists($obj, $key) ? $obj[$key] : $defaultValue;
//        return $val ? 1 : 0;
//    }
//}

// check and get value
if (!function_exists('valueDate')) {
    function valueDate($data){
        return !empty($data) ? date('Y-m-d', strtotime($data)) : null;
    }
}

// Convert array to object
if (!function_exists('obj')) {
    function obj($data){
        return (object)$data;
    }
}

// Make short description
if (!function_exists('getShortDescription')) {
    function getShortDescription($string, $maxLength = 100){
        if (strlen($string) > $maxLength) {
            $shorter = substr($string, 0, $maxLength + 1);
            $string = substr($string, 0, strrpos($shorter, ' ')) . '...';
        }
        return $string;
    }


// Errors helpers |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
// return 404 error
    if (!function_exists('error404')) {
        function error404($pageType = 'a'){
            // a: admin, u: user
            $viewFolderName = $pageType = 'a' ? 'admin' : 'user';
            return view($viewFolderName . '.errors.404');
        }
    }
}

if (!function_exists('getConstLabel')) {
    function getConstLabel($obj, $id){
        foreach ($obj as $i => $row) {
            if ($row['id'] == $id) {
                return $row;
            }
        }
        return [];
    }
}
// Get file manager routes
//if (!function_exists('getFileManagerRoutes')) {
//    function getFileManagerRoutes(){
//        return json_encode([
//            'show' => route('file.manager.show'),
//            'store' => route('file.manager.store'),
//            'destroy' => route('file.manager.destroy'),
//        ]);
//    }
//}


// Navigation helpers |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
// Highlights the selected item navigation
if (!function_exists('isActiveItem')) {
    function isActiveItem($routes, $className = 'active'){
//        return Request::url();
        return str_contains(Request::url(), $routes) ? $className : '';
//        if (!is_array($routes)) $routes = [$routes];
//        return in_array(Route::currentRouteName(), $routes) ? $className : '';
    }
}

// Collapse show the selected navigation
if (!function_exists('isActiveCollapse')) {
    function isActiveCollapse($routes, $className = 'show'){
        if (!is_array($routes)) $routes = [$routes];
        return in_array(Route::currentRouteName(), $routes) ? $className : '';
    }
}

// Collapse area expanded the selected navigation
if (!function_exists('isAreaExpanded')) {
    function isAreaExpanded($routes, $className = 'true'){
        if (!is_array($routes)) $routes = [$routes];
        return in_array(Route::currentRouteName(), $routes) ? $className : '';
    }
}

// Path helpers |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
// Get public image dir path
if (!function_exists('getAsset')) {
    function getAsset($fileName){
        return asset('public/admin-assets/' . $fileName);
    }
}


// Printing helpers |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('a')) {
    function a(){
        foreach (func_get_args() as $key => $value) {
            $checkType = gettype($value) == 'object' || gettype($value) == 'array';
            try {
                $value = $value->toArray();
            } catch (Throwable $e) {
            }
            $value = json_encode($value);
            $ddString = '
            <html>
                <head>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
                          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
                            crossorigin="anonymous"></script>
                    <script>
                        JSONViewer = (function () {
                            var JSONViewer = function () {
                                this._dom = {};
                                this._dom.container = document.createElement("pre");
                                this._dom.container.classList.add("json-viewer");
                            };
                            JSONViewer.prototype.showJSON = function (json, maxLvl, colAt) {
                                maxLvl = typeof maxLvl === "number" ? maxLvl : -1; // max level
                                colAt = typeof colAt === "number" ? colAt : -1; // collapse at

                                var jsonData = this._processInput(json);
                                var walkEl = this._walk(jsonData, maxLvl, colAt, 0);

                                this._dom.container.innerHTML = "";
                                this._dom.container.appendChild(walkEl);
                            };

                            JSONViewer.prototype.getContainer = function () {
                                return this._dom.container;
                            };

                            JSONViewer.prototype._processInput = function (json) {
                                if (json && typeof json === "object") {
                                    return json;
                                } else {
                                    throw "Input value is not object or array!";
                                }
                            };

                            JSONViewer.prototype._walk = function (value, maxLvl, colAt, lvl) {
                                var frag = document.createDocumentFragment();
                                var isMaxLvl = maxLvl >= 0 && lvl >= maxLvl;
                                var isCollapse = colAt >= 0 && lvl >= colAt;

                                switch (typeof value) {
                                    case "object":
                                        if (value) {
                                            var isArray = Array.isArray(value);
                                            var items = isArray ? value : Object.keys(value);

                                            if (lvl === 0) {
                                                // root level
                                                var rootCount = this._createItemsCount(items.length);
                                                // hide/show
                                                var rootLink = this._createLink(isArray ? "[" : "{");

                                                if (items.length) {
                                                    rootLink.addEventListener("click", function () {
                                                        if (isMaxLvl) return;

                                                        rootLink.classList.toggle("collapsed");
                                                        rootCount.classList.toggle("hide");

                                                        // main list
                                                        this._dom.container.querySelector("ul").classList.toggle("hide");
                                                    }.bind(this));

                                                    if (isCollapse) {
                                                        rootLink.classList.add("collapsed");
                                                        rootCount.classList.remove("hide");
                                                    }
                                                } else {
                                                    rootLink.classList.add("empty");
                                                }

                                                rootLink.appendChild(rootCount);
                                                frag.appendChild(rootLink);
                                            }

                                            if (items.length && !isMaxLvl) {
                                                var len = items.length - 1;
                                                var ulList = document.createElement("ul");
                                                ulList.setAttribute("data-level", lvl);
                                                ulList.classList.add("type-" + (isArray ? "array" : "object"));

                                                items.forEach(function (key, ind) {
                                                    var item = isArray ? key : value[key];
                                                    var li = document.createElement("li");

                                                    if (typeof item === "object") {
                                                        var isEmpty = false;

                                                        // null && date
                                                        if (!item || item instanceof Date) {
                                                            li.appendChild(document.createTextNode(isArray ? "" : key + ": "));
                                                            li.appendChild(this._createSimple(item ? item : null));
                                                        }
                                                        // array & object
                                                        else {
                                                            var itemIsArray = Array.isArray(item);
                                                            var itemLen = itemIsArray ? item.length : Object.keys(item).length;

                                                            // empty
                                                            if (!itemLen) {
                                                                li.appendChild(document.createTextNode(key + ": " + (itemIsArray ? "[]" : "{}")));
                                                            } else {
                                                                // 1+ items
                                                                var itemTitle = (typeof key === "string" ? key + ": " : "") + (itemIsArray ? "[" : "{");
                                                                var itemLink = this._createLink(itemTitle);
                                                                var itemsCount = this._createItemsCount(itemLen);

                                                                // maxLvl - only text, no link
                                                                if (maxLvl >= 0 && lvl + 1 >= maxLvl) {
                                                                    li.appendChild(document.createTextNode(itemTitle));
                                                                } else {
                                                                    itemLink.appendChild(itemsCount);
                                                                    li.appendChild(itemLink);
                                                                }

                                                                li.appendChild(this._walk(item, maxLvl, colAt, lvl + 1));
                                                                li.appendChild(document.createTextNode(itemIsArray ? "]" : "}"));

                                                                var list = li.querySelector("ul");
                                                                var itemLinkCb = function () {
                                                                    itemLink.classList.toggle("collapsed");
                                                                    itemsCount.classList.toggle("hide");
                                                                    list.classList.toggle("hide");
                                                                };

                                                                // hide/show
                                                                itemLink.addEventListener("click", itemLinkCb);

                                                                // collapse lower level
                                                                if (colAt >= 0 && lvl + 1 >= colAt) {
                                                                    itemLinkCb();
                                                                }
                                                            }
                                                        }
                                                    }
                                                    // simple values
                                                    else {
                                                        // object keys with key:
                                                        if (!isArray) {
                                                            li.appendChild(document.createTextNode(key + ": "));
                                                        }

                                                        // recursive
                                                        li.appendChild(this._walk(item, maxLvl, colAt, lvl + 1));
                                                    }

                                                    // add comma to the end
                                                    if (ind < len) {
                                                        li.appendChild(document.createTextNode(","));
                                                    }

                                                    ulList.appendChild(li);
                                                }, this);

                                                frag.appendChild(ulList);
                                            } else if (items.length && isMaxLvl) {
                                                var itemsCount = this._createItemsCount(items.length);
                                                itemsCount.classList.remove("hide");

                                                frag.appendChild(itemsCount);
                                            }

                                            if (lvl === 0) {
                                                // empty root
                                                if (!items.length) {
                                                    var itemsCount = this._createItemsCount(0);
                                                    itemsCount.classList.remove("hide");

                                                    frag.appendChild(itemsCount);
                                                }

                                                // root cover
                                                frag.appendChild(document.createTextNode(isArray ? "]" : "}"));

                                                // collapse
                                                if (isCollapse) {
                                                    frag.querySelector("ul").classList.add("hide");
                                                }
                                            }
                                            break;
                                        }

                                    default:
                                        // simple values
                                        frag.appendChild(this._createSimple(value));
                                        break;
                                }

                                return frag;
                            };
                            JSONViewer.prototype._createSimple = function (value) {
                                var spanEl = document.createElement("span");
                                var type = typeof value;
                                var txt = value;

                                if (type === "string") {
                                    txt = "&quot;" + value + "&quot;";
                                } else if (value === null) {
                                    type = "null";
                                    txt = "null";
                                } else if (value === undefined) {
                                    txt = "undefined";
                                } else if (value instanceof Date) {
                                    type = "date";
                                    txt = value.toString();
                                }

                                spanEl.classList.add("type-" + type);
                                spanEl.innerHTML = txt;

                                return spanEl;
                            };

                            JSONViewer.prototype._createItemsCount = function (count) {
                                var itemsCount = document.createElement("span");
                                itemsCount.classList.add("items-ph");
                                itemsCount.classList.add("hide");
                                itemsCount.innerHTML = this._getItemsTitle(count);

                                return itemsCount;
                            };

                            JSONViewer.prototype._createLink = function (title) {
                                var linkEl = document.createElement("a");
                                linkEl.classList.add("list-link");
                                linkEl.href = "javascript:void(0)";
                                linkEl.innerHTML = title || "";

                                return linkEl;
                            };

                            JSONViewer.prototype._getItemsTitle = function (count) {
                                var itemsTxt = count > 1 || count === 0 ? "items" : "item";

                                return (count + " " + itemsTxt);
                            };

                            return JSONViewer;
                        })();
                    </script>
                    <style>

                        input:focus, textarea:focus {
                            transition: 0.2s;
                        }

                        body {
                            background-color: #444444;
                            font-family: "Open Sans", Helvetica, sans-serif;
                        }

                        .container {
                            /*width: 100%;*/
                            margin: 30px auto;
                            align-items: center;
                        }

                        #three {
                            width: 100%;
                            float: left;
                            margin-left: 1%;
                            margin-top: -12px;
                        }


                        .load-json, .reset, .collapse, .expand, [type^="button"] {
                            padding: 0.9375em 1.875em;
                            border: 0;
                            border-radius: 0.4em;
                            color: #fff;
                            text-transform: uppercase;
                            font-size: 0.875em;
                            font-weight: 400;
                            transition: opacity 0.2s;
                            /*   display: block; */
                            width: 100%;
                        }

                        .load-json:hover, .reset:hover, .collapse:hover, .expand:hover, [type^="button"]:hover {
                            opacity: 0.75;
                            cursor: pointer;
                        }

                        .load-json {
                            background-color: #3BAFDA;
                        }

                        .reset {
                            background-color: #e87376;
                        }

                        .collapse {
                            background-color: #D770AD;
                        }

                        .expand {
                            background-color: #F6BB42;
                        }

                        [type^="button"] {
                            margin-bottom: 1.42857em;
                            width: 120px;
                            margin-right: 0.625em;
                            outline: none;
                        }

                        .json-viewer {
                            display: inline-block;
                            /*   overflow: scroll; */
                            /*   height:  563px; */
                            width: 100%;
                            color: #787A91;
                            padding: 10px 10px 10px 20px;
                            background-color: #171717;
                            border: 6px solid #362222;
                            border-radius: 0.4em;
                            margin-bottom: 3px;
                        }

                        .json-viewer ul {
                            list-style-type: none;
                            margin: 0;
                            margin: 0 0 0 1px;
                            border-left: 3px dotted #444444;
                            padding-left: 2em;
                        }

                        .json-viewer .hide {
                            display: none;
                        }

                        .json-viewer ul li .type-string,
                        .json-viewer ul li .type-date {
                            color: #1597BB;
                        }

                        .json-viewer ul li .type-boolean {
                            color: #D89216;
                            font-weight: bold;
                        }

                        .json-viewer ul li .type-number {
                            color: #A7D129;
                        }

                        .json-viewer ul li .type-null {
                            color: #F05454;
                        }

                        .json-viewer a.list-link {
                            color: #bbbdce;
                            text-decoration: none;
                            position: relative;
                        }

                        .json-viewer a.list-link:before {
                            color: #9C3D54;
                            /*color: #B55400;*/
                            content: "\25BC";
                            position: absolute;
                            display: inline-block;
                            width: 1em;
                            left: -1em;
                        }

                        .json-viewer a.list-link.collapsed:before {
                            content: "\25B6";
                        }

                        .json-viewer a.list-link.empty:before {
                            content: "";
                        }

                        .json-viewer .items-ph {
                            color: #aaa;
                            padding: 0 1em;
                        }

                        .json-viewer .items-ph:hover {
                            text-decoration: underline;
                        }

                        li.active {
                            background-color: rgba(120, 122, 145, 0.1);
                        }


                    </style>
                </head>


                <body>
                <div class="container">
                    <div id="three">
                        <div id="json"></div>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $("li").hover(function () {
                            $("li").removeClass("active");
                            $(this).addClass("active");
                        });

                        $("body").not(".json-viewer").hover(function () {
                            $("li").removeClass("active");
                            $(this).addClass("active");
                        });
                    })

                    var jsonObj = {};
                    var jsonViewer = new JSONViewer();
                    document.querySelector("#json").appendChild(jsonViewer.getContainer());

                    var textarea = document.querySelector("textarea");

                    // textarea value to JSON object
                    var setJSON = function () {
                        try {
                            var value = JSON.stringify(' . $value . ');
                            jsonObj = JSON.parse(value);
                        } catch (err) {
                            alert(err);
                        }
                    };

                    // load default value
                    setJSON();

                    var collapseBtn = document.querySelector("button.collapse");
                    var expandBtn = document.querySelector("button.expand");
                    var resetBtn = document.querySelector("button.reset");


                    setJSON();
                    jsonViewer.showJSON(jsonObj);


                    collapseBtn.addEventListener("click", function () {
                        jsonViewer.showJSON(jsonObj, null, 1);
                    });

                    expandBtn.addEventListener("click", function () {
                        setJSON();
                        jsonViewer.showJSON(jsonObj);
                    });

                    resetBtn.addEventListener("click", function () {
                        document.getElementById("msg").value = "";
                    });


                </script>
                </body>

                </html>';

            $ddObject = '
            <html>
                <head>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
                          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
                            crossorigin="anonymous"></script>

                    <style>

                        input:focus, textarea:focus {
                            transition: 0.2s;
                        }

                        body {
                            background-color: #444444;
                            font-family: "Open Sans", Helvetica, sans-serif;
                        }

                        .container {
                            /*width: 100%;*/
                            margin: 30px auto;
                            align-items: center;
                        }

                        #three {
                            width: 100%;
                            float: left;
                            margin-left: 1%;
                            margin-top: -12px;
                        }


                        .load-json, .reset, .collapse, .expand, [type^="button"] {
                            padding: 0.9375em 1.875em;
                            border: 0;
                            border-radius: 0.4em;
                            color: #fff;
                            text-transform: uppercase;
                            font-size: 0.875em;
                            font-weight: 400;
                            transition: opacity 0.2s;
                            /*   display: block; */
                            width: 100%;
                        }

                        .load-json:hover, .reset:hover, .collapse:hover, .expand:hover, [type^="button"]:hover {
                            opacity: 0.75;
                            cursor: pointer;
                        }

                        .load-json {
                            background-color: #3BAFDA;
                        }

                        .reset {
                            background-color: #e87376;
                        }

                        .collapse {
                            background-color: #D770AD;
                        }

                        .expand {
                            background-color: #F6BB42;
                        }

                        [type^="button"] {
                            margin-bottom: 1.42857em;
                            width: 120px;
                            margin-right: 0.625em;
                            outline: none;
                        }

                        .json-viewer {
                            display: inline-block;
                            /*   overflow: scroll; */
                            /*   height:  563px; */
                            width: 100%;
                            color: #787A91;
                            padding: 10px 10px 10px 20px;
                            background-color: #171717;
                            border: 6px solid #362222;
                            border-radius: 0.4em;
                            margin-bottom: 3px;
                        }

                        .json-viewer ul {
                            list-style-type: none;
                            margin: 0;
                            margin: 0 0 0 1px;
                            border-left: 3px dotted #444444;
                            padding-left: 2em;
                        }

                        .json-viewer .hide {
                            display: none;
                        }

                        .json-viewer ul li .type-string,
                        .json-viewer ul li .type-date {
                            color: #1597BB;
                        }

                        .json-viewer ul li .type-boolean {
                            color: #D89216;
                            font-weight: bold;
                        }

                        .json-viewer ul li .type-number {
                            color: #A7D129;
                        }

                        .json-viewer ul li .type-null {
                            color: #F05454;
                        }

                        .json-viewer a.list-link {
                            color: #bbbdce;
                            text-decoration: none;
                            position: relative;
                        }

                        .json-viewer a.list-link:before {
                            color: #9C3D54;
                            /*color: #B55400;*/
                            content: "\25BC";
                            position: absolute;
                            display: inline-block;
                            width: 1em;
                            left: -1em;
                        }

                        .json-viewer a.list-link.collapsed:before {
                            content: "\25B6";
                        }

                        .json-viewer a.list-link.empty:before {
                            content: "";
                        }

                        .json-viewer .items-ph {
                            color: #aaa;
                            padding: 0 1em;
                        }

                        .json-viewer .items-ph:hover {
                            text-decoration: underline;
                        }

                        li.active {
                            background-color: rgba(120, 122, 145, 0.1);
                        }


                    </style>
                </head>


                <body>
                <div class="container">
                    <div id="three">
                        <div id="json">
                            <pre class="json-viewer"><h5 style="font-size: 20px;color: #1597BB">' . $value . '</h5></pre>
                        </div>
                    </div>
                </div>

                </body>

                </html>';
            if ($checkType) {
                print_r($ddString);
            } else {
                print_r($ddObject);
            }
        }
        exit();
    }
}



