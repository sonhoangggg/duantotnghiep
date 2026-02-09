@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h4>Thương hiệu</h4>
        <a href="{{ route('admin.thuong-hieu.create') }}" class="btn btn-primary">
            Thêm thương hiệu
        </a>
    </div>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Logo</th>
                <th>Slug</th>
                <th width="150">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($thuongHieus as $th)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $th->ten }}</td>
                <td>
                    @if($th->logo)
                        <img src="{{ asset('storage/'.$th->logo) }}" width="60">
                    @endif
                </td>
                <td>{{ $th->slug }}</td>
                <td>
                    <a href="{{ route('admin.thuong-hieu.edit', $th->id) }}"
                       class="btn btn-sm btn-warning">Sửa</a>

                    <form action="{{ route('admin.thuong-hieu.destroy', $th->id) }}"
                          method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Xóa?')">
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
