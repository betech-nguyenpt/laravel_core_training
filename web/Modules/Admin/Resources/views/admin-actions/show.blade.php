@php
$theme = Config::get('app.theme');
@endphp
@extends($theme . '.layouts.show')

@section('header_content')
Show action: {{ $model->name }}
@endsection
@section('data_content')
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
        <label class=" form-control-label">Key</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->key }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Controller Id</label>
    </div>
    <div class="col-12 col-md-9">
        @php
        echo $model->getControllerLink();
        @endphp
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Permission</label>
    </div>
    <div class="col-12 col-md-9">
        @php
        echo $model->getPermission();
        @endphp
    </div>
</div>
@endsection