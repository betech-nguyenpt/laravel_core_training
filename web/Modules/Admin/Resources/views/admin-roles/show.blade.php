@php
use Modules\Admin\Entities\AdminModule;
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
        <label class=" form-control-label">Name</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->name }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Code</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->code }}</p>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Weight</label>
    </div>
    <div class="col-12 col-md-9">
        <p class="form-control-static">{{ $model->weight }}</p>
    </div>
</div>
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
@endsection