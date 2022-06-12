@php
use Modules\Admin\Entities\AdminModule;
$theme = Config::get('app.theme');
@endphp
@extends($theme . '.layouts.form')

@section('form_content')
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('type', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ Form::text('type', $model->type, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('receiver_id', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ Form::text('receiver_id', $model->receiver_id, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('content', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ Form::text('content', $model->content, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('url', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ Form::text('url', $model->url, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('status', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ Form::text('status', $model->status, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('created_by', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ Form::text('created_by', $model->created_by, ['class' => 'form-control']) }}
        </div>
    </div>
@endsection
