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
            <label class=" form-control-label">Type</label>
        </div>
        <div class="col-12 col-md-9">
            <p class="form-control-static">{{ $model->type }}</p>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Receiver ID</label>
        </div>
        <div class="col-12 col-md-9">
            <p class="form-control-static">{{ $model->receiver_id }}</p>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Content</label>
        </div>
        <div class="col-12 col-md-9">
            <p class="form-control-static">{{ $model->content }}</p>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">URL</label>
        </div>
        <div class="col-12 col-md-9">
            <p class="form-control-static">{{ $model->url }}</p>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Status</label>
        </div>
        <div class="col-12 col-md-9">
            <p class="form-control-static">{{ $model->status }}</p>
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Created_by</label>
        </div>
        <div class="col-12 col-md-9">
            <p class="form-control-static">{{ $model->created_by }}</p>
        </div>
    </div>
@endsection
