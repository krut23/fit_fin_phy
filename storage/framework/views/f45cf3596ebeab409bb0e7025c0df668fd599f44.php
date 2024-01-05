<div
    class="col-12 col-md-{{input.col}}"
    ng-repeat="(key, input) in thisForm"
    ng-class="{'g-0': !input.label, 'd-contents': input.type == 'hidden'}"
    ng-if="input.type && !input.isHideField"
>

    

    <!-- Form -->
    <div class="mb-3">
        <label class="form-label" for="input_{{$index}}" ng-if="input.label && input.label != 'hidden' && input.label != 'line'">
            {{input.label}}
            <i class="text-danger" ng-if="input.isRequired">*</i>
            <i class="text-success" ng-class="{'text-danger': input.val.length > input.lan}" ng-if="input.lan">({{input.val | getLength}} Char)</i>
            <i class="bi-question-circle text-body ms-1"
                ng-if="input.tooltip"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                title=""
                data-bs-original-title="{{input.tooltip}}"
                aria-label="{{input.tooltip}}">
            </i>
        </label>

        <ANY ng-switch="input.type">

            <!-- Custom Form Input -->
            <?php echo $__env->make('admin.modals.forms.form-input-custom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- End Custom Form Input -->

            <!-- Text Editor -->
            <ANY ng-switch-when="line">
                <input type="text" id="exampleFormControlInput2" class="form-control form-control-title mt-5 border-top pt-2" placeholder="{{ input.val }}" readonly>
            </ANY>

            <!-- Text Editor -->
            <ANY ng-switch-when="text-editor">
                <div class="quill-editor" text-angular="text-angular" name="htmlContent" ng-model="input.val" ta-disabled='false'></div>
            </ANY>

            <!-- Selection List -->
            <ANY ng-switch-when="selection-list">
                <select
                    class="form-select form-select-sm {{env.FormSettings.formInputSize}}"
                    ng-class="{
                        'is-valid': !input.msg && input.msg !== undefined,
                        'is-invalid': input.msg && input.msg !== undefined,
                    }"
                    id="input_{{$index}}"
                    ng-model="input.val"
                >
                    <option value="">{{ input.select.label }}</option>
                    <option value="{{option[input.select.valueKey]}}" ng-repeat="option in input.select.options">{{option[input.select.key]}}</option>
                </select>
                <!-- {inputType: 'selection-list', select: {options: $rootScope.selectionObj.archive, key: 'name', valueKey: 'id', label: '- Select Status -'}} -->
            </ANY>

            <!-- Selection Search-->
            <ANY ng-switch-when="selection-search">
                <div class="form-control select-ul {{env.FormSettings.formInputSize}}" ng-init="selectUl()">
                    <label ng-click="input.select.search[input.select.key] = ''">
                        {{input.select.label ? input.select.label : '- Select '+input.label+' -'}}
                        <i class="bi-chevron-down  l-icon"></i></label>
                    <ul>
                        <li ng-show="input.select.isShowSearch">
                            <input type="text" class="form-control form-select-sm" ng-model="input.select.search[input.select.key]">
                        </li>
                        <li class="option" ng-repeat="option in input.select.options | filter: input.select.search"
                            ng-click="input.val = option.id;input.select.label = option[input.select.key]"
                            ng-class="{'select-ul-active':input.val == option.id}"
                            
                            >
                            {{option[input.select.key]}}
                            <ANY class="d-none">{{input.select.label = input.val == option.id ? option[input.select.key] : input.select.label}}</ANY>
                        </li>
                    </ul>
                </div>
            </ANY>


            <!-- Image -->
            <ANY ng-switch-when="image">
                <input
                    type="file"
                    class="form-control {{env.FormSettings.formInputSize}}"
                    ng-class="{
                        'is-valid': !input.msg && input.msg !== undefined,
                        'is-invalid': input.msg && input.msg !== undefined,
                    }"
                    accept="image/*"
                    id="input_{{$index}}"
                    ng-fileread="input.val"
                /><br>

                <div class="avatar avatar-xl" ng-if="input.val">
                    <img class="avatar-img" ng-src="{{input.val}}" alt="Image" ng-class="{'img-gray':deleteFileList.includes(key)}">
                </div>

                <ANY class="pointer" ng-if="!input.val && input.temp">
                    <div class="avatar avatar-xl">
                        <img class="avatar-img" alt="Image" ng-src="{{input.temp}}" ng-click="showImagePreview(input.temp)" ng-class="{'img-gray':deleteFileList.includes(key)}"/>
                    </div>
                </ANY>

                <ANY class="pointer" ng-if="input.isDelete && (input.val || input.temp)">
                    <i class="fad fa-trash-alt fa-lg text-danger" ng-click="addDeleteFileList(key, 1)"
                       ng-if="!deleteFileList.includes(key)"></i>
                    <i class="fad fa-trash-undo-alt fa-lg text-success" ng-click="addDeleteFileList(key, 0)"
                       ng-if="deleteFileList.includes(key)"></i>
                </ANY>

                <!-- {isDelete: true} -->
            </ANY>

            <ANY ng-switch-when="file">
                <input
                    type="file"
                    class="form-control {{env.FormSettings.formInputSize}}"
                    ng-class="{
                        'is-valid': !input.msg && input.msg !== undefined,
                        'is-invalid': input.msg && input.msg !== undefined,
                    }"
                    accept="{{ input.acceptType || '*' }}"
                    id="input_{{$index}}"
                    ng-file="input.val"
                /><br>
                <a class="latest-post" href="{{input.temp}}" target="_blank" ng-if="!input.val && input.temp">
                    <strong><i class="fad fa-paperclip"></i> View</strong>
                </a>
            </ANY>

            <!-- Textarea -->
            <ANY ng-switch-when="textarea">
                <textarea
                    class="form-control {{env.FormSettings.formInputSize}}"
                    ng-class="{
                        'is-valid': !input.msg && input.msg !== undefined,
                        'is-invalid': input.msg && input.msg !== undefined,
                    }"
                    name="{{key}}"
                    placeholder="{{ input.placeholder }}"
                    aria-label="{{ input.placeholder }}"
                    id="input_{{$index}}"
                    ng-model="input.val"
                    rows="{{input.rows}}"></textarea>
            </ANY>

            <!-- Switch -->
            <ANY ng-switch-when="switch">
                <div class="form-check form-switch form-switch-between" ng-class="{'d-inline': input.isInline}">
                    <label class="form-check-label">{{ input.switchLabel.off }}</label>
                    <input
                        type="checkbox"
                        class="form-check-input {{ input.className }}"
                        id="input_{{$index}}"
                        ng-checked="input.val"
                        ng-click="input.val = !input.val"
                    >
                    <label class="form-check-label">{{ input.switchLabel.on }}</label>
                    <!-- {switchLabel: {on: 'Archive', off: 'Unarchived'}, className: 'is-valid', isInline: false} -->

                </div>

            </ANY>

            <!-- Capital Text -->
            <ANY ng-switch-when="text-capital">
                <input
                    type="{{input.type}}"
                    class="form-control {{env.FormSettings.formInputSize}}"
                    ng-class="{
                        'is-valid': !input.msg && input.msg !== undefined,
                        'is-invalid': input.msg && input.msg !== undefined,
                    }"
                    name="{{key}}"
                    placeholder="{{input.placeholder}}"
                    aria-label="{{input.placeholder}}"
                    id="input_{{$index}}"
                    ng-model="input.val"
                    capital-Check
                />
            </ANY>


            <!-- Read Only -->
            <ANY ng-switch-when="readonly">
                <input
                    type="text"
                    class="form-control {{env.FormSettings.formInputSize}}"
                    ng-class="{
                        'is-valid': !input.msg && input.msg !== undefined,
                        'is-invalid': input.msg && input.msg !== undefined,
                    }"
                    name="{{key}}"
                    placeholder="{{input.placeholder}}"
                    aria-label="{{input.placeholder}}"
                    id="input_{{$index}}"
                    ng-model="input.val"
                    readonly
                />
            </ANY>


            <!-- Default -->
            <ANY ng-switch-default>
                <input
                    type="{{input.type}}"
                    class="form-control {{env.FormSettings.formInputSize}}"
                    ng-class="{
                        'is-valid': !input.msg && input.msg !== undefined,
                        'is-invalid': input.msg && input.msg !== undefined,
                    }"
                    name="{{key}}"
                    placeholder="{{input.placeholder}}"
                    aria-label="{{input.placeholder}}"
                    id="input_{{$index}}"
                    ng-model="input.val"
                />
            </ANY>


        </ANY>
        <!-- Field require message -->
        <span class="invalid-feedback d-inline">{{input.msg}}</span>

    </div>


</div>
<?php /**PATH C:\xampp\htdocs\projects\fit-fin-phy\resources\views/admin/modals/forms/form-input.blade.php ENDPATH**/ ?>