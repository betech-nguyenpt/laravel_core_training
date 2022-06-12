@php
$theme = Config::get('app.theme');
use Modules\Admin\Entities\AdminFile;
use \Modules\Admin\Entities\AdminUser;
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
            <th>Type of relation</th>
            <th>Record relate with file</th>
            <th>Type of file</th>
            <th>Order number</th>
            <th>Name of file</th>
            <th>Image</th>
            <th>Description</th>
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
            <td>{{ $item->getNameRelationType() }}</td>
            <td>{{ $item->belong_id }}</td>
            <td>{{ $item->getNameFileType()}}</td>
            <td>{{ $item->order_number }}</td>
            <td>{{ $item->file_name }}</td>
            <td>{!! $item->file_type == AdminFile::FILE_TYPE_IMAGE ?
                $item->getViewThumbImage(80) : $item->getViewThumbCommon(80)
                !!}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->getNameStatus() }}</td>
            <td>{{ $item->created_date }}</td>
            <td>{{ $item->getCreatorName() }}</td>
            <td>
                <div class="table-data-feature">
                    <a class="item" href="{{ route($controller . '.show', $item->id) }}"><i
                            class="zmdi zmdi-mail-send"></i></a>
                    <a class="item" href="{{ route($controller . '.edit', $item->id) }}"><i
                            class="zmdi zmdi-edit"></i></a>
                    <form action="{{ route('admin.doDelete', $item->id) }}" method="POST">
                        @csrf
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
