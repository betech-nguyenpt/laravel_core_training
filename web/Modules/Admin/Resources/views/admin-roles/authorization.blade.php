@php
use Modules\Admin\Entities\AdminModule;
use Modules\Admin\Entities\AdminPermissionRole;
use App\Utils\HtmlHandler;
$theme = Config::get('app.theme');
$arrModules = AdminModule::loadItems();
@endphp
@extends($theme . '.layouts.show')

@section('header_content')
Show module: {{ $model->name }}
@endsection
@section('data_content')
<div class="row form-group">
    <h2>Permission</h2>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    @foreach($arrModules as $module)
        <li class="nav-item">
            <a class="nav-link" id="tab-{{ $module->name }}" data-toggle="tab" href="#{{ $module->name }}" role="tab" aria-controls="{{ $module->name }}" aria-selected="false">
                {{ $module->name }}
            </a>
        </li>
    @endforeach
</ul>
<div class="tab-content pl-3 p-1" id="myTabContent">
    @foreach($arrModules as $module)
    <div class="tab-pane fade" id="{{ $module->name }}" role="tabpanel" aria-labelledby="{{ $module->name }}-tab">
        <div class="form-group row">
        @foreach($module->getListControllers() as $mController)
        <div class="border col-md-4">
            <table class="table table-borderless table-striped table-earning" style="width: 100%; table-layout: fixed;">
                <thead>
                    <tr>
                        <th style="width: 70%;">{{ $mController->name }}</th>
                        <th style="width: 30%;">
                            <label class="switch switch-text switch-success switch-pill">
                                <input type="checkbox" id="{{ $mController->id }}" controller_id ="{{$mController->id}}"  class="switch-input check-all">
                                <span data-on="On" data-off="Off" class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mController->getListActions() as $mAction)
                    @if (!$mAction->isPublic())
                    <tr>
                        <td style="width: 70%;">{{ $mAction->name }}</td>
                        <td style="width: 30%;">
                            <label class="switch switch-text {{ HtmlHandler::randomSwitch() }}">
                                <input type="checkbox" id="{{ $mController->id . '_' . $mAction->key }}" class="switch-input action"
                                       {{ AdminPermissionRole::canAccess($model->id, $mController->id, $mAction->key) ? 'checked' : '' }}
                                >
                                <span data-on="On" data-off="Off" class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // Loop for all select all checkbox
        $(".check-all").each(function(index, item) {
            var id = $(item).attr('id');
            fnUpdateSelectAllStatus(id);
        });
    });
    fnHandleSelectAll();
    fnHandleSelectAction();
    
    //-----------------------------------------------------
    // Utility methods
    //-----------------------------------------------------
    /**
     * Handle select all actions checkbox
     * @returns {undefined}
     */
    function fnHandleSelectAll() {
        $('.check-all').change(function () {
            var id = $(this).attr('id');
            var isChecked = $(this).is(":checked");
            $("input[id^='" + id + "']").prop("checked", isChecked);
//            if (isChecked) {
//                $("input[id^='" + id + "']").prop("checked", true);
//            } else {
//                $("input[id^='" + id + "']").prop("checked", false);
//            }
            fnSaveController(id, isChecked);
        });
    }
    
    /**
     * Handle select action checkbox
     * @returns {undefined}
     */
    function fnHandleSelectAction() {
        // If click on action checkbox
        $('.action').change(function() {
            // Get current action element id
            var id = $(this).attr('id');
            var isChecked = $(this).is(":checked");
            // Get current controller id
            var controllerId = id.substring(0, id.lastIndexOf('_'));
            fnUpdateSelectAllStatus(controllerId);
            fnSaveAction(id, isChecked);
        });
    }
    
    /**
     * Update select all checkbox status
     * @param {String} controllerId Id of controller
     * @returns {undefined}
     */
    function fnUpdateSelectAllStatus(controllerId) {
        var checkedCnt = 0;
        // Get number of actions element (in same controller)
        var actionCount = $("input[id^='" + controllerId + "_']").length;
        // Loop for all actions element (in same controller)
        $("input[id^='" + controllerId + "_']").each(function(index, item) {
            // If item is checked
            if ($(item).is(":checked")) {
                checkedCnt++;
            }
        });
        if (actionCount === checkedCnt) {           // Checked all
            // Set checked
            $("#" + controllerId).prop("checked", true);
        } else {              // Checked none
            // Set unchecked
            $("#" + controllerId).prop("checked", false);
        } 
    }
    
    /**
     * Save action for permission.
     * @param {String} action_key   Key of action
     * @param {String} canAccess    Flag can access
     */
    function fnSaveAction(action_key, canAccess) {
        console.log('prepare save controller_action: ' + action_key + ', can access: ' + canAccess);
        // Handle save value when check/uncheck 1 action
        $.ajax({
            type: "GET",
            url: 'permission',
            data: {
                id: {{ $model->id }},
                data: action_key,
                can_access: canAccess
            },
            success: function (html) {
                if (html['status'] === '1') {
                    console.log('Request fnSaveAction success');
                } else {
                    console.log('Request fnSaveAction failed');
                    // Revert value of switch
                    $('#' + action_key).prop("checked", !canAccess);
                }
            },
            error: function (jqXHR, textStatus) {
                alert(jqXHR.responseText);
            }
          });
    }
    
    /**
     * Save all actions (in 1 controller) for permission.
     * @param {String} controller_id    Id of controller
     * @param {String} canAccess        Flag can access
     */
    function fnSaveController(controller_id, canAccess) {
        // Handle save value when check/uncheck 1 controller
        console.log('prepare save controller: ' + controller_id + ', can access: ' + canAccess);
        // Handle save value when check/uncheck 1 action
        $.ajax({
            type: "GET",
            url: 'permissionAll',
            data: {
                id: {{ $model->id }},
                controller_id: controller_id,
                can_access: canAccess
            },
            success: function (html) {
                if (html['status'] === '1') {
                    console.log('Request fnSaveController success');
                } else {
                    console.log('Request fnSaveController failed');
                    // Revert value of switch
                    $('#' + controller_id).prop("checked", !canAccess);
                }
            },
            error: function (jqXHR, textStatus) {
                alert(jqXHR.responseText);
            }
          });
    }
</script>
@endsection