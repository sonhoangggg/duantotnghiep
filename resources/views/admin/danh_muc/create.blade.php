@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Thêm danh mục</h4>

    <form action="{{ route('admin.danh-muc.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

        <div class="mb-3">
            <label class="form-label">Tên danh mục</label>
            <input type="text" name="ten" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục cha</label>
            <select name="parent_id" class="form-select">
                <option value="">-- Không có --</option>
                @foreach($danhMucs as $dm)
                    <option value="{{ $dm->id }}">{{ $dm->ten }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Logo</label>
            <input type="file" name="logo" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="mo_ta" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Lưu</button>
<a href="{{ route('admin.danh-muc.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
