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
        <label class=" form-control-label">Name</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->name }}</p>
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
        <label class=" form-control-label">Module Id</label>
    </div>
    <div class="col-12 col-md-9">
        @php
        echo $model->getModuleLink();
        @endphp
    </div>
</div>
@endsection