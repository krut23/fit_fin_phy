<!-- Checkbox Model -->
<ANY ng-switch-when="checkbox-model">
    <ANY ng-repeat="rowList in input.val">
        <!-- Checkbox -->
        <div class="form-check mb-3">
            <input type="checkbox" id="formCheck_{{key}}_{{ rowList.id }}" ng-model="rowList.is_selected" ng-checked="rowList.is_selected" class="form-check-input">
            <label class="form-check-label" for="formCheck_{{key}}_{{ rowList.id }}">{{rowList.name}}</label>
        </div>
        <!-- End Checkbox -->
    </ANY>

</ANY>


<ANY ng-switch-when="showLink">
    <a class="latest-post" ng-if="input.val" href="{{input.val}}" target="_blank">
        <strong><i class="fad fa-paperclip"></i> View</strong> </a>
</ANY>


<ANY ng-switch-when="selected-languages">
    <div class="form-check mb-3" ng-repeat="option in selectionObj.languages">
        <input type="checkbox" id="selection_language_{{option.id}}" class="form-check-input" ng-checked="input.val.includes(option.id)" ng-click="toggleCheck(option.id, input.val)">
        <label class="form-check-label" for="selection_language_{{option.id}}">{{option.name}}</label>
    </div>
</ANY>

<ANY ng-switch-when="menu-builder">
    
    <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-4">
            <ul class="list-group" style="max-width: 450px;">
                <li class="list-group-item bg-soft-secondary" ng-repeat="row in input.val" ng-click="showSubMenu(input.val, $index)">
                    <input type="text" class="form-control-borderless form-control-flush bg-soft-secondary mt-3" ng-model="row.label">
                    <div class="float-end">

                        <span class="fs-1 d-block">&ensp;<i class="far fa-arrow-square-up text-secondary c-pointer " ng-click="swipeListOrder(input.val, $index, $index-1)" ng-hide="$index-1 < 0"></i></span>
                        <span class="fs-1 d-block">&ensp;<i class="far fa-arrow-square-down text-secondary c-pointer " ng-click="swipeListOrder(input.val, $index, $index+1)" ng-hide="$index+1 >= input.val.length"></i></span>
                    </div>
                </li>

            </ul>
        </div>
        <div class="col-lg-4 mb-4 mb-lg-4" ng-show="input.val[currentSubMenu].items.length">
            <h4>{{ input.val[currentSubMenu].label }}</h4>
            <ul class="list-group list-group list-group-striped" style="max-width: 450px;">
                <li class="list-group-item  bg-soft-secondary" ng-repeat="row in input.val[currentSubMenu].items">
                    <input type="text" class="form-control-borderless form-control-flush bg-soft-secondary mt-3" ng-model="row.label">
                    <div class="float-end">
                        <span class="fs-1 d-block">&ensp;<i class="far fa-arrow-square-up text-secondary c-pointer " ng-click="swipeListOrder(input.val[currentSubMenu].items, $index, $index-1)" ng-hide="$index-1 < 0"></i></span>
                        <span class="fs-1 d-block">&ensp;<i class="far fa-arrow-square-down text-secondary c-pointer " ng-click="swipeListOrder(input.val[currentSubMenu].items, $index, $index+1)" ng-hide="$index+1 >= input.val.length"></i></span>
                    </div>
                </li>

            </ul>
        </div>


    </div>
</ANY>

<?php /**PATH /home/prayosh1/public_html/fit_fin_phy/resources/views/admin/modals/forms/form-input-custom.blade.php ENDPATH**/ ?>