{{--
Sao chép toàn bộ trang này.
Tạo view tạo trong folder admin vào view/admin/ten folder/index....
vd: view/admin/products/index.balde.php
--}}





@extends('layouts.admin')

{{-- Tiêu đề trang --}}
@section('title', 'Them Thuộc Tính Cho Sản Phẩm')



@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
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
        <!-- end page title -->


        <div>
            <div class="card">
                <div class="card-header">
                    {{-- <h4 class="card-title"></h4> --}}
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.san-pham.luu-thuoc-tinh-san-pham', ['slug' => $sanPham->slug]) }}" method="POST">
                        @csrf
                        <select name="thuoc_tinh[]" class="select2 form-control select2-multiple " multiple
                            data-placeholder="--Chọn--">
                            @foreach ($thuocTinhs as $thuocTinh)
                                <option value="{{ $thuocTinh->id }}">{{ $thuocTinh->ten }}</option>
                            @endforeach
                        </select>
                        @error('thuoc_tinh')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        @if($errors->has('thuoc_tinh_check'))
                            <div class="text-danger mt-2">{{ $errors->first('thuoc_tinh_check') }}</div>
                        @endif
                        <button class="btn btn-success mt-3">Lưu</button>
                    </form>
                </div>
            </div>
        </div>



    </div> <!-- container -->

    </div>

@endsection




@push('css')
    <link href="{{ asset('assets/admin/assets/vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush



@push('js')
    <script src="{{ asset('assets/admin/assets/vendor/select2/js/select2.min.js') }}"></script>
    <script>
        $(".select2").select2();
    </script>
@endpush
