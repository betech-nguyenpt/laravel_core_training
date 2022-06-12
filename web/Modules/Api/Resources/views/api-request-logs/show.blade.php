@php
$theme = Config::get('app.theme');
@endphp
@extends($theme . '.layouts.show')

@section('header_content')
Show menu: {{ $model->name }}
@endsection
@section('data_content')
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Logtime</label>
    </div>
    <div class="col-12 col-md-9">
        @php
        echo $model->getLogtime();
        @endphp
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Level</label>
    </div>
    <div class="col-12 col-md-9">
        @php
        echo $model->getLevel();
        @endphp
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Message</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->message }}</p>
    </div>
</div>
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
        <label class=" form-control-label">Category</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->category }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">IP Address</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->ip_address }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Country</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->country }}</p>
    </div>
</div>
@endsection