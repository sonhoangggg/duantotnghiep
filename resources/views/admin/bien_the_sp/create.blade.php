{{--
Sao chép toàn bộ trang này.
Tạo view tạo trong folder admin vào view/admin/ten folder/index....
vd: view/admin/products/index.balde.php
--}}

@extends('layouts.admin')

{{-- Tiêu đề trang --}}
@section('title', 'Them biến thể sản phẩm')

{{-- Nội dung trang --}}



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
            <form action="{{ route('admin.san-pham.bien-the.luu', $sanPham->slug) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Thuộc tính sản phẩm</h4>

                    </div>
                    <div class="card-body">

                        @if ($thuoc_tinhs)
                            @foreach ($thuoc_tinhs as $ten => $id)
                                <label class="form-label">{{ $ten }}</label>

                                <select class="form-control" name="gia_tri_thuoc_tinh[]">
                                    <option value="">--Chọn--</option>

                                    @foreach ($gia_tri_thuoc_tinh[$id] ?? [] as $giaTriId => $tenGiaTri)
                                        <option value="{{ $giaTriId }} ">{{ $tenGiaTri }}</option>
                                    @endforeach

                                </select>
                            @endforeach
                        @endif

                        @error('gia_tri_thuoc_tinh.*')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if ($errors->has('to_hop_gia_tri'))
                            <div class="text-danger">
                                {{ $errors->first('to_hop_gia_tri') }}
                            </div>
                        @endif


                    </div>

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card  ">
                            <div class="card-header py-2">
                                <h4 class="header-title">Ảnh biến thể</h4>
                            </div>
                            <div class="card-body row">
                                <div class="position-relative p-0">

                                    <label for="chonAnh"
                                        class="w-100 p-4 text-center border border-dashed  cursor-pointer">
                                        <div id="upload-text">
                                            <i class="ri-upload-cloud-2-line fs-1"></i>
                                            <p class="mb-0">Click để chọn tệp</p>
                                        </div>

                                        <img id="preview-img" src="" class="img-fluid d-none"
                                            style="max-height:200px; object-fit:cover;">
                                    </label>

                                    <input type="file" name="anh_bien_the" class="d-none" id="chonAnh"
                                        accept="image/*">

                                    <!-- nút xoá -->
                                    <button type="button" id="removeImg"
                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 d-none">
                                        ✕
                                    </button>
                                </div>
                                @error('anh_bien_the')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="header-title">Thông tin sản phẩm</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="" class="form-lable">SKU</label>
                                        <input type="text" value="{{ old('sku_bien_the') }}" class="form-control"
                                            name="sku_bien_the" id="">
                                        @error('sku_bien_the')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="mb-3 col-6">
                                        <label for="" class="form-lable">Số lượng</label>
                                        <input type="text" value="{{ old('so_luong') }}" class="form-control"
                                            name="so_luong" id="">
                                        @error('so_luong')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="" class="form-lable">Giá thông thường</label>
                                        <input type="text" value="{{ old('gia_tt') }}" class="form-control"
                                            name="gia_tt" id="">
                                        @error('gia_tt')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="" class="form-lable">Giá khuyến mãi</label>
                                        <input type="text" value="{{ old('gia_km') }}" class="form-control"
                                            name="gia_km" id="">
                                        @error('gia_km')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mr-2">
                                        <div class="form-check form-switch ">
                                            <input type="checkbox" class="form-check-input" id="customSwitch1"
                                                name="trang_thai">
                                            <label class="form-check-label" for="customSwitch1">Hiển thị biến thể</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="header-title">Thông số sản phẩm</h4>
                            </div>
                            <div class="card-body row">
                                <select name="thong_so[]" class="select2 form-control select2-multiple thong_so" multiple
                                    data-placeholder="--Chọn--">
                                    @foreach ($thongSos as $thongSo)
                                        <option value="{{ $thongSo->id }}">{{ $thongSo->ten }}</option>
                                    @endforeach
                                </select>

                                <div class="mt-3">
                                    @foreach ($thongSos as $thongSo)
                                        <div class="thong-so-item d-none" data-id="{{ $thongSo->id }}">
                                            <label class="form-label">{{ $thongSo->ten }}</label>
                                            <input type="text" name="gia_tri_thong_so[{{ $thongSo->id }}]"
                                                class="form-control" placeholder="Nhập {{ $thongSo->ten }}">
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-success mb-3">Lưu thuộc tính</button>
            </form>
        </div>



    </div> <!-- container -->

    </div>

@endsection




@push('css')
    <link href="{{ asset('assets/admin/assets/vendor/select2/css/select2.min.css') }}" rel="stylesheet"
        type="text/css" />
@endpush



@push('js')
    <script src="https://cdn.tiny.cloud/1/dzxe6fk2z4sikdvqeb1bpq0m0k7rir7gtshf2uwjcja7ov87/tinymce/8/tinymce.min.js"
        referrerpolicy="origin" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
    <script src="{{ asset('assets/admin/assets/vendor/select2/js/select2.min.js') }}"></script>





    <script>
        const input = document.getElementById('chonAnh');
        const previewImg = document.getElementById('preview-img');
        const removeBtn = document.getElementById('removeImg');
        const uploadText = document.getElementById('upload-text');

        input.addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('d-none');
                removeBtn.classList.remove('d-none');
                uploadText.classList.add('d-none');
            };
            reader.readAsDataURL(file);
        });

        // Xoá ảnh
        removeBtn.addEventListener('click', function() {
            input.value = '';
            previewImg.src = '';
            previewImg.classList.add('d-none');
            removeBtn.classList.add('d-none');
            uploadText.classList.remove('d-none');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.thong_so').select2();

            $('.thong_so').on('change', function() {
                let selectedIds = $(this).val() || [];

                // Ẩn tất cả
                $('.thong-so-item').addClass('d-none');

                // Hiện các thông số được chọn
                selectedIds.forEach(id => {
                    $('.thong-so-item[data-id="' + id + '"]').removeClass('d-none');
                });
            });
        });
    </script>
@endpush
