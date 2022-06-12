@php
$theme = Config::get('app.theme');
@endphp
@extends($theme . '.layouts.index')

@section('data_content')
<table class="table table-data2">
    <thead>
        <tr>
            <th>
                <label class="au-checkbox">
                    <input type="checkbox">
                    <span class="au-checkmark"></span>
                </label>
            </th>
            <th>No</th>
            <th>Session</th>
            <th>IP Address</th>
            <th>Module</th>
            <th>Controller</th>
            <th>Action</th>
            <th>Browser</th>
            <th>Os</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
       @foreach ($models as $item)
        <tr class="tr-shadow">
            <td>
                <label class="au-checkbox">
                    <input type="checkbox">
                    <span class="au-checkmark"></span>
                </label>
            </td>
            <td>{{ ++$i }}</td>
            <td>{{ $item->session }}</td>
            <td>{{ $item->ip_address }}</td>
            <td>{{ $item->module }}</td>
            <td>{{ $item->controller }}</td>
            <td>{{ $item->action }}</td>
            <td>{{ $item->browser }}</td>
            <td>{{ $item->os }}</td>
            <td>
                <div class="table-data-feature">
                    <a class="item" href="{{ route($controller . '.show', $item->id) }}"><i class="zmdi zmdi-mail-send"></i></a>
                    <a class="item" href="{{ route($controller . '.edit', $item->id) }}"><i class="zmdi zmdi-edit"></i></a>
                    <form action="{{ route($controller . '.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="item" data-toggle="tooltip" data-placement="top" type="submit"><i class="zmdi zmdi-delete"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        <tr class="spacer"></tr>
        @endforeach
    </tbody>
</table>
@endsection