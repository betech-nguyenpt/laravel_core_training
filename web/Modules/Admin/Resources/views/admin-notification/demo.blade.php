@php
$theme = Config::get('app.theme');
@endphp

@extends($theme . '.layouts.show')

@section('header_content')
    Admin Notification
    @if (Session::exists('sendSuccess'))
        <div class="alert alert-success">
            <strong>{{ Session::get('sendSuccess') }}</strong>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('data_content')
    {{ Form::open(['route' => ['admin-notification.send'], 'method' => 'post']) }}
    <div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Type</label>
        </div>
        <div class="col-12 col-md-9">
            {{ Form::select('type', $typeArr, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Receiver ID</label>
        </div>
        <div class="col-12 col-md-9">
            {{ Form::number('receiver_id', '', ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Content</label>
        </div>
        <div class="col-12 col-md-9">
            {{ Form::text('content', '', ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="row form-group">
        <div class="col col-md-4">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> Submit
            </button>
        </div>
    </div>
    {{ Form::close() }}
@endsection
