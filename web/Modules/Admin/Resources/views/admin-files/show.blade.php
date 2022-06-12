@php
$theme = Config::get('app.theme');
use Modules\Admin\Entities\AdminFile;
use Modules\Admin\Entities\AdminUser;
use App\Utils\StringExt;
@endphp
@extends($theme . '.layouts.show')

@section('header_content')
Edit Controller: Admin Files
@endsection
@section('data_content')
<div class="card-body card-block">
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('type', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ $model->getNameRelationType() }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('belong_id', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ $model->belong_id }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('file_type', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ $model->getNameFileType()}}
        </div>
    </div>

    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('order_number', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ $model->order_number }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('file_name', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ $model->file_name }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('description', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ $model->description }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('status', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ $model->getNameStatus() }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('created_by', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ $model->getCreatorName() }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('created_date', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="col-12 col-md-9">
            {{ $model->created_date }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            {{ Form::label('File Upload', null, ['class' => 'form-control-label']) }}
        </div>
        <div class="fallback col-12 col-md-9">
            @if ($model->file_type == AdminFile::FILE_TYPE_IMAGE)
            {!! $model->getViewThumbImage(300) !!}
            @endif
            @if ($model->file_type == AdminFile::FILE_TYPE_VIDEO)
            <video width="800" controls>
                <source src="{{ $model->getFileURL() }}" type="video/mp4">
            </video>
            @endif
            @if ($model->file_type == AdminFile::FILE_TYPE_DOCUMENT || $model->file_type == AdminFile::FILE_TYPE_OTHER)
            {!! $model->getViewThumbCommon(80) !!}
            @endif
        </div>
    </div>
    @if ($model->file_type == AdminFile::FILE_TYPE_DOCUMENT)
        @if (StringExt::getExtension($model->file_name)==".pdf")
        <embed src="{{  $model->getFileURL() }}" style="width: 100%; height: 600px">
        @else
        <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{  $model->getFileURL() }}' style="width: 100%; height: 600px"
            frameborder='0'>
        </iframe>
        @endif
    @endif
</div>
@endsection
