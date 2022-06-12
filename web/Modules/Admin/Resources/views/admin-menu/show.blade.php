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
        <label class=" form-control-label">Name</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->name }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Parent</label>
    </div>
    <div class="col-12 col-md-9">
        @php
        echo $model->getParentLink();
        @endphp
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Url</label>
    </div>
    <div class="col-12 col-md-9">
        @php
        echo $model->getFullUrl();
        @endphp
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Icon</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->icon }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Type</label>
    </div>
    <div class="col-12 col-md-9">
        @php
        echo $model->getType();
        @endphp
    </div>
</div>
@endsection