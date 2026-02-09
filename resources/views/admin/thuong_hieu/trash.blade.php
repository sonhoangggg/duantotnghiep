@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Thùng rác thương hiệu</h4>

    <a href="{{ route('admin.thuong-hieu.index') }}"
       class="btn btn-secondary mb-3">Quay lại</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th width="200">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($thuongHieus as $th)
            <tr>
                <td>{{ $th->id }}</td>
                <td>{{ $th->ten }}</td>
                <td>
                    <form action="{{ route('admin.thuong-hieu.restore', $th->id) }}"
                          method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-success">Khôi phục</button>
                    </form>

                    <form action="{{ route('admin.thuong-hieu.forceDelete', $th->id) }}"
                          method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Xóa vĩnh viễn?')">
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
