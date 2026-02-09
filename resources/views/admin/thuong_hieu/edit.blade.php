@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Sửa thương hiệu</h4>

    <form action="{{ route('admin.thuong-hieu.update', $thuongHieu->id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên thương hiệu</label>
            <input type="text" name="ten"
                   value="{{ $thuongHieu->ten }}"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Logo</label>
            <input type="file" name="logo" class="form-control">

            @if($thuongHieu->logo)
                <img src="{{ asset('storage/'.$thuongHieu->logo) }}"
                     width="80" class="mt-2">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="mo_ta"
                class="form-control">{{ $thuongHieu->mo_ta }}</textarea>
        </div>

        <button class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.thuong-hieu.index') }}"
           class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
