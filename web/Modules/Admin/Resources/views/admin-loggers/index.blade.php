@php
$theme = Config::get('app.theme');
@endphp
@extends($theme . '.layouts.index')
@section('list_action_buttons')
<a class="btn btn-success" href="{{ url('admin/admin-loggers/delete') }}">
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
            <th>Logtime</th>
            <th>Level</th>
            <th>Message</th>
            <th>Description</th>
            <th>Category</th>
            <th>IP Address</th>
            <th>Country</th>
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
            <td>
                @php
                echo $item->getLogtime();
                @endphp
            </td>
            <td>
                @php
                echo $item->getLevel();
                @endphp
            </td>
            <td>{{ $item->message }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->category }}</td>
            <td>{{ $item->ip_address }}</td>
            <td>{{ $item->country }}</td>
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