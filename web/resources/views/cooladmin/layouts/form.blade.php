@extends('cooladmin.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            @if (isset($getForgotPassword))
                <h3 class="title-5 m-b-35">Reset Password</h3>
            @else
                <h3 class="title-5 m-b-35">Edit</h3>
            @endif
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

@if (Session::exists('warning'))
<div class="alert alert-danger">
    <strong>Whoops!</strong> The email you entered does not exist.<br><br>
</div>
@elseif (Session::exists('success'))
<div class="alert alert-success">
    <strong>Email has been sent, check your mailbox.</strong>
</div>
@endif

@if (Session::exists('passwordNotMatch'))
<div class="alert alert-danger">
    <strong>Whoops!</strong> Password don't match<br><br>
</div>
@elseif (Session::exists('oldPasswordIncorrect'))
<div class="alert alert-danger">
    <strong>Old Password is incorrect</strong>
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                
                <div class="pull-left">
                    @if (isset($getForgotPassword))
                        Reset Password
                    @else
                        Edit Controller: {{ $model->name }}
                    @endif
                </div>
            </div>

            @if (isset($newPassword))
            {{ Form::open(['route' => ['newPassword'], 'method' => 'post']) }}
            @endif
            @if (isset($changePassword))
            {{ Form::open(['route' => ['changePassword'], 'method' => 'post']) }}
            @endif
            @if (isset($getForgotPassword))
            {{ Form::open(['route' => ['resetPassword'], 'method' => 'post']) }}
            @endif
            @if (isset($model->id))
            {{ Form::model($model, ['route' => [$controller . '.update', $model->id], 'method' => 'put']) }}
            @else
            {{ Form::model($model, ['route' => [$controller . '.store'], 'method' => 'post']) }}
            @endif
            <div class="card-body card-block">
                @yield('form_content')
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