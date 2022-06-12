@php
$theme = Config::get('app.theme');
@endphp
@extends($theme . '.layouts.show')

@section('header_content')
Show controller: {{ $model->name }}
@endsection
@section('data_content')
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">one_id</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->one_id }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">many_id</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->many_id }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">type</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->type }}</p>
    </div>
</div>
@endsection
