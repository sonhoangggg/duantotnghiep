@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Thùng rác danh mục</h4>

    <a href="{{ route('admin.danh-muc.index') }}"
       class="btn btn-secondary mb-3">
        Quay lại
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th width="200">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($danhMucs as $dm)
                <tr>
                    <td>{{ $dm->id }}</td>
                    <td>{{ $dm->ten }}</td>
                    <td>
                        <form action="{{ route('admin.danh-muc.restore', $dm->id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-success">
                                Khôi phục
                            </button>
                        </form>

                        <form action="{{ route('admin.danh-muc.forceDelete', $dm->id) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Xóa vĩnh viễn?')">
                            @csrf
                            <button class="btn btn-sm btn-danger">
                                Xóa hẳn
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
