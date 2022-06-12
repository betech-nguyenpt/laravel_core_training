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
            <th>Description</th>
            <th>Action</th>
            <th>Model</th>
            <th>Id of Model</th>
            <th>Field Name</th>
            <th>Old value</th>
            <th>New value</th>
            <th>Created date</th>
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
                echo $item->description;
                @endphp
            </td>
            <td>{{ $item->action }}</td>
            <td>{{ $item->model }}</td>
            <td>{{ $item->model_id }}</td>
            <td>{{ $item->field }}</td>
            <td>{{ $item->old_value }}</td>
            <td>{{ $item->new_value }}</td>
            <td>{{ $item->created_at }}</td>
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