@php
$theme = Config::get('app.theme');
use Modules\Admin\Entities\AdminSetting;
@endphp
@extends($theme . '.layouts.master')

@section('content')
<div class="table-data__tool">
    <div class="table-data__tool-left">

    </div>
    <div class="table-data__tool-right">
        <a class="btn btn-success" href="{{ route('admin-settings.create') }}">
            <i class="zmdi zmdi-plus"></i> Create</a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="default-tab">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach ($aSettings as $key => $aSetting)
                    <a class="nav-item nav-link {{ $key == 0 ? 'active show' : '' }}"
                        id="nav-{{ $aSetting['alias'] }}-tab" data-toggle="tab" href="#nav-{{ $aSetting['alias'] }}"
                        role="tab" aria-controls="nav-{{ $aSetting['alias'] }}"
                        aria-selected="false">{{ $aSetting['alias'] }}</a>
                    @endforeach
                </div>
            </nav>
            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                {{ Form::open(['route' => ['admin.update-admin-settings'], 'method' => 'post']) }}
                @foreach ($aSettings as $key => $aSetting)
                <div class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}" id="nav-{{ $aSetting['alias'] }}"
                    role="tabpanel" aria-labelledby="nav-{{ $aSetting['alias'] }}-tab">
                    @foreach ($aSetting['children'] as $item => $type)
                    <div class="row form-group">
                        <div class="col col-md-3">
                            {{ Form::label($item, null, ['class' => 'form-control-label']) }}
                        </div>
                        <div class="col-12 col-md-3">
                            @if ($type == "select")
                            {{ Form::$type($item, $selectValue[$item], AdminSetting::getValue($item), ['class' => 'form-control']) }}
                            @endif
                            @if ($type == "checkbox")
                            {{ Form::checkbox($item, AdminSetting::getValue($item), AdminSetting::getValue($item))}}
                            @endif
                            @if ($type != "select" && $type != "checkbox")
                            {{ Form::input($type, $item, AdminSetting::getValue($item), ['class' => 'form-control']) }}
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
                <div hidden>
                    {{ Form::text('updated', date('Y-m-d H:i:s'), ['class' => 'form-control']) }}
                </div>
                <button type="submit" class="btn btn-info">
                    Save
                </button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
