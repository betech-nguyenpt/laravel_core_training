@php
use Modules\Admin\Entities\AdminModule;
use Modules\Admin\Entities\AdminPermissionUser;
$theme = Config::get('app.theme');
$arrModules = AdminModule::loadItems();
@endphp
@extends($theme . '.layouts.show')

@section('header_content')
Show module: {{ $model->name }}
@endsection
@section('data_content')

<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Username</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->username }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Email</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->email }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Name</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->name }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Role</label>
    </div>
    <div class="col-12 col-md-9">
        @php
        echo $model->getRoleLink();
        @endphp
    </div>
</div>
<div class="row form-group" id_model ='{{$model->id}}'>
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
                            <label class="switch switch-3d switch-primary mr-3">
                                <input type="checkbox" id="{{ $mController->name }}" controller_id ="{{$mController->id}}"  class="switch-input check-all">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mController->getListActions() as $mAction)
                    <tr>
                        <td style="width: 70%;">{{ $mAction->name }}</td>
                        <td style="width: 30%;">
                            <label class="switch switch-3d switch-primary mr-3">
                                <input type="checkbox" id="{{ $mController->name . '_' . $mAction->key }}" class="switch-input action"
                                       {{ AdminPermissionUser::getCanAccess($model->id, $mController->id, $mAction->key) ? 'checked' : '' }}
                                >
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
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
            if (isChecked) {
                $("input[id^='" + id + "']").prop("checked", true);
            } else {
                $("input[id^='" + id + "']").prop("checked", false);
            }
            //fnSaveController(id);
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
            // Get current controller id
            var controllerId = id.substring(0, id.lastIndexOf('_'));
            fnUpdateSelectAllStatus(controllerId);
            fnSaveAction(id);
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
    function fnSaveAction(action_id) {
        // Handle save value when check/uncheck 1 action
    }
    function fnSaveController(controller_id) {
        // Handle save value when check/uncheck 1 controller
    }
</script>
@endsection
