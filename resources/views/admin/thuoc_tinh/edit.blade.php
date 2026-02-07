{{--
Sao chép toàn bộ trang này.
Tạo view tạo trong folder admin vào view/admin/ten folder/index....
vd: view/admin/products/index.balde.php
--}}





@extends('layouts.admin')

{{-- Tiêu đề trang --}}
@section('title', 'default')



@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Velonic</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">Starter</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Starter</h4>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                <h4></h4>
            </div>
            <div class="card-body">
                <div>
                    <form action="{{ route('admin.thuoc-tinh.cap-nhap', $thuocTinh->id) }}" method="post">
                        @csrf
                        <div class="d-flex gap-4 mb-3">
                            <div class="w-50">
                                <label for="" class="form-label">Tên <span class="text-danger">*</span></label>
                                <input type="text" value="{{ $thuocTinh->ten }}" name="ten" class="form-control">
                                @error('ten')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-50">
                                <label for="" class="form-label">Kiểu</label>
                                <select name="kieu" class="form-select">
                                    <option selected value="{{ $thuocTinh->kieu }}">{{ $thuocTinh->kieu }} </option>
                                    <option value="">Chọn kiểu</option>
                                    <option value="mau">Màu</option>
                                    <option value="anh">Ảnh</option>
                                    <option value="chuoi">Chuỗi</option>
                                </select>
                                @error('kieu')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-success">Sửa</button>
                    </form>
                </div>
            </div>
        </div>



    </div> <!-- container -->

    </div>
    </div>
@endsection




@push('css')
    {{-- Css viết ở đây nha --}}
@endpush



@push('js')
    {{-- Js viết ở đây nha --}}
@endpush
