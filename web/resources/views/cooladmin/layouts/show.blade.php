@extends('cooladmin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="pull-left">
            <h3 class="title-5 m-b-35">Show module</h3>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route($controller . '.index') }}"> Back</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    @yield('header_content')
                </div>
            </div>
            <div class="card-body card-block">
                @yield('data_content')
            </div>
        </div>
    </div>
</div>
@endsection