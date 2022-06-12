@php
use \Modules\Admin\Entities\AdminModule;
$theme = Config::get('app.theme');
@endphp
@extends($theme . '.layouts.form')

@section('form_content')
<div class="row form-group">
    <div class="col col-md-3">
        {{ Form::label('key', null, ['class' => 'form-control-label']) }}
    </div>
    <div class="col-12 col-md-9">
        {{ Form::text('key', $model->key, ['class' => 'form-control']) }}
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        {{ Form::label('value', null, ['class' => 'form-control-label']) }}
    </div>
    <div class="col-12 col-md-9">
        {{ Form::text('value', $model->value, ['class' => 'form-control']) }}
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        {{ Form::label('description', null, ['class' => 'form-control-label']) }}
    </div>
    <div class="col-12 col-md-9">
        {{ Form::text('description', $model->description, ['class' => 'form-control']) }}
    </div>
</div>
<div class="row form-group" hidden>
    <div class="col-12 col-md-9">
        {{ Form::text('updated', date('Y-m-d H:i:s'), ['class' => 'form-control']) }}
    </div>
</div>
@endsection
