@php
$theme = Config::get('app.theme');
@endphp

@extends($theme . '.layouts.index')

@section('data_content')
    <a href="{{ route('admin-notification.demo') }}" class="btn btn-outline-primary ">
        AdminNotification Demo Tool
    </a>
    <table class="table table-data2">
        <thead>
            <tr>
                <th>No</th>
                <th>Type</th>
                <th>Receiver ID</th>
                <th>Content</th>
                <th>URL</th>
                <th>Status</th>
                <th>Created By</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($models as $item)
                <tr class="tr-shadow">
                    <td>{{ ++$i }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->receiver_id }}</td>
                    <td>{!! $item->content !!}</td>
                    <td>{{ $item->url }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->created_by }}</td>
                    <td>
                        <div class="table-data-feature">
                            <a class="item" href="{{ route($controller . '.show', $item->id) }}"><i
                                    class="zmdi zmdi-mail-send"></i></a>
                            <a class="item" href="{{ route($controller . '.edit', $item->id) }}"><i
                                    class="zmdi zmdi-edit"></i></a>
                            <form action="{{ route($controller . '.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="item" data-toggle="tooltip" data-placement="top" type="submit"><i
                                        class="zmdi zmdi-delete"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr class="spacer"></tr>
            @endforeach
        </tbody>
    </table>
@endsection
