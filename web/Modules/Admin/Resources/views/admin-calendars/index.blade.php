@php
$theme = Config::get('app.theme');
$url = 'themes/cooladmin/';
@endphp
@extends($theme . '.layouts.master')

@section('content')
<style>
    .modal-backdrop {
        z-index: -1 !important;
    }
</style>
<div class="row" ng-controller="CalendarController">
    <div class="col-md-12">
        @if(isset($userName))
        <button class="btn btn-success mb-2" data-toggle="modal" data-target="#mediumModal"
            ng-click="create=true; reset()"><i class="zmdi zmdi-plus"></i> Create</button>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2" ng-init="getListCalendars()">
                <thead>
                    <tr>
                        <th rowspan="2">Action</th>
                        {{-- <th rowspan="2">id</th> --}}
                        <th rowspan="2">name</th>
                        <th rowspan="2">color</th>
                        {{-- <th rowspan="2">changeKey</th> --}}
                        <th rowspan="2">Share</th>
                        <th rowspan="2">ViewPrivateItems</th>
                        <th rowspan="2">Edit</th>
                        <th rowspan="2">allowedOnlineMeetingProviders</th>
                        <th rowspan="2">defaultOnlineMeetingProvider</th>
                        <th rowspan="2">TallyingResponses</th>
                        <th colspan="2">owner</th>
                    </tr>
                    <tr>
                        <th>name</th>
                        <th>address</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tr-shadow" ng-repeat-start="calendar in calendars">
                        <td>
                            <div class="table-data-feature">
                                <button class="item" ng-click="editCalendar(calendar)" data-toggle="modal"
                                    data-target="#mediumModal">
                                    <i class="zmdi zmdi-edit"></i></button>
                                <button class="item" confirmed-click="deleteCalendar(calendar.id, $index)"
                                    ng-confirm-click="Are you sure to delete this record ?">
                                    <i class="zmdi zmdi-delete"></i></button>
                            </div>
                        </td>
                        {{-- <td>@{{ calendar.id }}</td> --}}
                        <td>@{{ calendar.name }}</td>
                        <td>@{{ calendar.color }}</td>
                        {{-- <td>@{{ calendar.changeKey }}</td> --}}
                        <td><input type="checkbox" ng-model="calendar.canShare" /></td>
                        <td><input type="checkbox" ng-model="calendar.canViewPrivateItems" /></td>
                        <td><input type="checkbox" ng-model="calendar.canEdit" /></td>
                        <td>@{{ calendar.allowedOnlineMeetingProviders[0] }}</td>
                        <td>@{{ calendar.defaultOnlineMeetingProvider }}</td>
                        <td><input type="checkbox" ng-model="calendar.isTallyingResponses" /></td>
                        <td>@{{ calendar.owner['name'] }}</td>
                        <td>@{{ calendar.owner['address'] }}</td>
                    </tr>
                    <tr class="spacer" ng-repeat-end></tr>
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel" ng-if="create">Create Calendar</h5>
                    <h5 class="modal-title" id="mediumModalLabel" ng-if="!create">Update Calendar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Name</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" name="name" id="name" class="form-control" ng-model="calendar.name"
                                    ng-model-options='{ debounce: 500 }' ng-init="searchCalendar()"
                                    ng-change="searchCalendar()">
                                <span ng-show="existName" style="color: red">Calendar name already exists.</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Color</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control" ng-model="calendar.color">
                                    <option value="-1" selected>Auto</option>
                                    <option value="0">LightBlue</option>
                                    <option value="1">LightGreen</option>
                                    <option value="2">LightOrange</option>
                                    <option value="3">LightGray</option>
                                    <option value="4">LightYellow</option>
                                    <option value="5">LightTeal</option>
                                    <option value="6">LightPink</option>
                                    <option value="7">LightBrown</option>
                                    <option value="8">LightRed</option>
                                    <option value="9">MaxColor</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="createCalendar()"
                        ng-disabled="existName" ng-if="create">Confirm</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="updateCalendar()"
                        ng-if="!create">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ url($url . 'angularjs/Controller/CalendarController.js')}}"></script>
@endsection
