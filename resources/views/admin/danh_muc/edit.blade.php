@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Sửa danh mục</h4>

 <form action="{{ route('admin.danh-muc.update', $danhMuc->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT') {{-- 🔥 DÒNG QUYẾT ĐỊNH --}}


        <div class="mb-3">
            <label class="form-label">Tên danh mục</label>
            <input type="text" name="ten"
                   value="{{ $danhMuc->ten }}"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" name="slug"
                   value="{{ $danhMuc->slug }}"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục cha</label>
           <select name="parent_id" class="form-select">
    <option value="">-- Không có --</option>

    @foreach($parents as $dm)
        <option value="{{ $dm->id }}"
            {{ $danhMuc->parent_id == $dm->id ? 'selected' : '' }}>
            {{ $dm->ten }}
        </option>
    @endforeach
</select>

        </div>

        <div class="mb-3">
            <label class="form-label">Logo</label>
            <input type="file" name="logo" class="form-control">
            @if($danhMuc->logo)
                <img src="{{ asset('storage/'.$danhMuc->logo) }}"
                     width="80" class="mt-2">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="mo_ta"
                class="form-control">{{ $danhMuc->mo_ta }}</textarea>
        </div>

        <button class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.danh-muc.index') }}"
           class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
