@php
$theme = Config::get('app.theme');
@endphp
@extends($theme . '.layouts.index')
@section('list_action_buttons')
<a class="btn btn-success" href="{{ url('api/api-reg-requests/delete') }}">
    <i class="zmdi zmdi-plus"></i> Delete All
</a>
@endsection
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
            <th>Phone</th>
            <th>Code</th>
            <th>Time Verify</th>
            <th>Status</th>
            <th>Created date</th>
            <th>Created by</th>
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
            <td>{{ $item->phone}}</td>
            <td>{{ $item->code}}</td>
            <td>{{ $item->time_vefiry}}</td>
            <td>{{ $item->getStatus()}}</td>
            <td>{{ $item->create_at}}</td>
            <td>{{ $item->created_by}}</td>
            <td>
                <div class="table-data-feature">
                    <a class="item" href="{{ route($controller . '.show', $item->id) }}"><i class="zmdi zmdi-mail-send"></i></a>
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
© 2020 GitHub, Inc.