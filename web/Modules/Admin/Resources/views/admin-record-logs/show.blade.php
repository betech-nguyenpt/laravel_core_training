@php
$theme = Config::get('app.theme');
@endphp
@extends($theme . '.layouts.show')

@section('header_content')
Show module: {{ $model->name }}
@endsection
@section('data_content')
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Description</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->description }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Action</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->action }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Model</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->model }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Id of model</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->model_id }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Field name</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->field }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Old value</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->old_value }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">New value</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->new_value }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Created date</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->created_at }}</p>
    </div>
</div>
@endsection