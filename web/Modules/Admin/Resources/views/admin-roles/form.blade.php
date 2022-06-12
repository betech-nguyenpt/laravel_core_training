@php
$theme = Config::get('app.theme');
@endphp
@extends($theme . '.layouts.form')

@section('form_content')
<div class="row form-group">
    <div class="col col-md-3">
        {{ Form::label('name', null, ['class' => 'form-control-label']) }}
    </div>
    <div class="col-12 col-md-9">
        {{ Form::text('name', $model->name, ['class' => 'form-control']) }}
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        {{ Form::label('code', null, ['class' => 'form-control-label']) }}
    </div>
    <div class="col-12 col-md-9">
        {{ Form::text('code', $model->code, ['class' => 'form-control']) }}
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        {{ Form::label('weight', null, ['class' => 'form-control-label']) }}
    </div>
    <div class="col-12 col-md-9">
        {{ Form::text('weight', $model->weight, ['class' => 'form-control']) }}
    </div>
</div>
@endsection

