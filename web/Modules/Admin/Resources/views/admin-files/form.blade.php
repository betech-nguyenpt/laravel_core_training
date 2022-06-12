@php
use \Modules\Admin\Entities\AdminFile;
use \Modules\Admin\Entities\AdminRole;
$theme = Config::get('app.theme');
@endphp
@extends($theme . '.layouts.master')

@section('content')
<style>
    .container {
        margin: 0 auto;
        width: 50%;
    }

    .content {
        padding: 5px;
        margin: 0 auto;
    }

    .content span {
        width: 250px;
    }

    .dz-message {
        text-align: center;
        font-size: 28px;
    }
</style>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3 class="title-5 m-b-35">Edit</h3>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route($controller . '.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    Edit Controller: Admin Files
                </div>
            </div>
            @if (isset($model->id))
            {{ Form::open(['route' => ['admin.doUpdate', $model->id], 'method' => 'post', 'files' => true]) }}
            @else
            {{ Form::open(['route' => ['admin.doUpload'], 'method' => 'post', 'files' => true]) }}
            @endif
            <div class="card-body card-block">
                <div class="row form-group">
                    <div class="col col-md-3">
                        {{ Form::label('type', null, ['class' => 'form-control-label']) }}
                    </div>
                    <div class="col-12 col-md-9">
                        {{ Form::select('type', $model->getArrayRelationType(), $model->type, ['class' => 'form-control', 'required']) }}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        {{ Form::label('belong_id', null, ['class' => 'form-control-label']) }}
                    </div>
                    <div class="col-12 col-md-9">
                        {{ Form::text('belong_id', $model->belong_id, ['class' => 'form-control', 'pattern'=>'^0*([0-9]|[1-8][0-9]|9[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$', 'required']) }}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        {{ Form::label('file_type', null, ['class' => 'form-control-label']) }}
                    </div>
                    <div class="col-12 col-md-9">
                        {{ Form::select('file_type', $model->getArrayFileType(), $model->file_type, ['class' => 'form-control', 'required']) }}
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        {{ Form::label('order_number', null, ['class' => 'form-control-label']) }}
                    </div>
                    <div class="col-12 col-md-9">
                        {{ Form::text('order_number', $model->order_number, ['class' => 'form-control', 'pattern'=>'^0*([0-9]|[1-8][0-9]|9[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$', 'required']) }}
                    </div>
                </div>
                @if (isset($model->id))
                <div class="row form-group">
                    <div class="col col-md-3">
                        {{ Form::label('file_name', null, ['class' => 'form-control-label']) }}
                    </div>
                    <div class="col-12 col-md-9">
                        {{ Form::text('file_name', $model->file_name, ['class' => 'form-control', 'required']) }}
                    </div>
                </div>
                @endif
                <div class="row form-group">
                    <div class="col col-md-3">
                        {{ Form::label('description', null, ['class' => 'form-control-label']) }}
                    </div>
                    <div class="col-12 col-md-9">
                        {{ Form::textarea('description', $model->description, ['rows' => '4','class' => 'form-control', 'required']) }}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        {{ Form::label('status', null, ['class' => 'form-control-label']) }}
                    </div>
                    <div class="col-12 col-md-9">
                        {{ Form::select('status', $model->getArrayStatus(),$model->status, ['class' => 'form-control', 'required']) }}
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        {{ Form::label('File Upload', null, ['class' => 'form-control-label']) }}
                    </div>
                    <div class="fallback col-12 col-md-9">
                        {{ Form::file('fileUpload', [
                            'required',
                            'class' => 'dropify'
                            ]) }}
                    </div>
                </div>
            </div>
            <div hidden>
                {{ Form::text('created_by', Auth::user()->id, ['class' => 'form-control']) }}
                {{ Form::text('created_date', date("Y-m-d H:i:s"), ['class' => 'form-control']) }}
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Submit
                </button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.dropify').dropify();
</script>
@endsection
