@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Danh mục</h4>
        <a href="{{ route('admin.danh-muc.create') }}" class="btn btn-primary">
            Thêm danh mục
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
    <th width="50">#</th>
    <th>Logo</th>
    <th>Tên danh mục</th>
    <th>Slug</th>
    <th>Mô tả</th>
    <th>Danh mục cha</th>
    <th width="160">Thao tác</th>
</tr>
                </thead>
                <tbody>
                    @forelse($danhMucs as $dm)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                             <td>
        @if($dm->logo)
            <img src="{{ asset('storage/'.$dm->logo) }}"
                 width="50"
                 class="rounded border">
        @else
            -
        @endif
    </td>
                            <td>{{ $dm->ten }}</td>
                            <td>{{ $dm->slug }}</td>
                            <td>{{ Str::limit($dm->mo_ta, 50) }}</td>
                            <td>{{ $dm->parent?->ten ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.danh-muc.edit', $dm->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Sửa
                                </a>

                                <form action="{{ route('admin.danh-muc.destroy', $dm->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Xóa danh mục này?')">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Chưa có danh mục nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
