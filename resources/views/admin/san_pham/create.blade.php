{{--
Sao chép toàn bộ trang này.
Tạo view tạo trong folder admin vào view/admin/ten folder/index....
vd: view/admin/products/index.balde.php
--}}

@extends('layouts.admin')

{{-- Tiêu đề trang --}}
@section('title', 'Thêm sản phẩm')



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
            <form action="{{ route('admin.san-pham.tao') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="header-title">Thông tin sản phẩm</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-12">
                                        <label for="" class="form-lable">Tên sản phẩm</label>
                                        <input type="text" class="form-control" name="ten_sp" id="">
                                        @error('ten_sp')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-12">
                                        <label for="" class="form-lable">Slug</label>
                                        <input type="text" class="form-control" name="slug_sp" id="">
                                        @error('slug_sp')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="" class="form-lable">Sku</label>
                                        <input type="text" class="form-control" name="sku_sp" id="">
                                        @error('sku_sp')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="" class="form-lable">Số lượng</label>
                                        <input type="text" class="form-control" name="so_luong" id="">
                                        @error('so_luong')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="" class="form-lable">Giá thông thường</label>
                                        <input type="text" class="form-control" name="gia_tt" id="">
                                        @error('gia_tt')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="" class="form-lable">Giá khuyến mãi</label>
                                        <input type="text" class="form-control" name="gia_km" id="">
                                        @error('gia_km')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="header-title">Mô tả ngắn</h4>
                            </div>
                            <div class="card-body">
                                <textarea name="mo_ta_ngan" id="moTaNgan"></textarea>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="header-title">Mô tả</h4>
                            </div>
                            <div class="card-body">
                                <textarea name="mo_ta" id="mytextarea"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="header-title">Xuất bản</h4>
                            </div>
                            <div class="card-body">
                                <button type="submit" class="btn btn-success mb-3">Xuất bản</button>
                                <div class="form-check form-switch">
                                    <label for="" class="form-check-lable">Sản phẩm nổi bật</label>
                                    <input type="checkbox" class="form-check-input " name="sp_noi_bat" id="">
                                </div>
                                <div class="form-check form-switch">
                                    <label for="" class="form-check-lable">Hiển thị sản phẩm</label>
                                    <input type="checkbox" class="form-check-input " name="sp_hien_thi" id="">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="header-title">Ảnh chính sản phẩm</h4>
                            </div>
                            <div class="card-body row">
                                <div class="position-relative p-0">

                                    <label for="chonAnh" class="w-100 text-center border border-dashed  cursor-pointer">
                                        <div id="upload-text">
                                            <i class="ri-upload-cloud-2-line fs-1"></i>
                                            <p class="mb-0">Click để chọn tệp</p>
                                        </div>

                                        <img id="preview-img" src="" class="img-fluid d-none"
                                            style="max-height:200px; object-fit:cover;">
                                    </label>

                                    <input type="file" name="anh_chinh" class="d-none" id="chonAnh"
                                        accept="image/*">

                                    <!-- nút xoá -->
                                    <button type="button" id="removeImg"
                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 d-none">
                                        ✕
                                    </button>
                                </div>
                                @error('anh_chinh')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="header-title">Album ảnh sản phẩm</h4>
                            </div>
                            <div class="card-body row">
                                <label for="uploadAlbum"
                                    class="w-100 text-center border border-dashed p-1    cursor-pointer ">
                                    <p class="mb-0">Click để chọn tệp</p>
                                </label>
                                <input type="file" name="anh_phu[]" multiple class="form-control d-none"
                                    id="uploadAlbum" accept="image/*">
                                <div id="preview-album" class="row mt-3 g-2 py-0">
                                    <img src="" alt="" class="img-fluid d-none">
                                </div>
                            </div>
                            @error('anh_phu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="header-title">Danh mục sản phẩm</h4>
                            </div>
                            <div class="card-body row">
                                <select name="danh_muc[]"
                                    class="select2 form-control select2-multiple select2-hidden-accessible"
                                    data-toggle="select2" multiple="" data-placeholder="--Chọn--"
                                    data-select2-id="select2-data-4-grkw" tabindex="-1" aria-hidden="true">
                                    @foreach ($danhMucs as $danhMuc)
                                        <option value="{{ $danhMuc->id }}">{{ $danhMuc->ten }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="header-title">Thương hiệu</h4>
                            </div>
                            <div class="card-body row">
                                <select name="thuong_hieu" class=" form-control ">
                                    <option value="">--Chọn--</option>
                                    @foreach ($thuongHieus as $thuongHieu)
                                        <option value="{{ $thuongHieu->id }}">{{ $thuongHieu->ten }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="header-title">Thông số sản phẩm</h4>
                            </div>
                            <div class="card-body row">
                                <select name="thong_so[]" class="select2 form-control select2-multiple" multiple
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
        tinymce.init({
            selector: '#moTaNgan',
            height: 300
        });
    </script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            height: 400,

            plugins: [
                'lists', 'link', 'image', 'code'
            ],

            toolbar: `
        undo redo |
        blocks |
        bold italic underline image |
        alignleft aligncenter alignright |
        bullist numlist |
        link  |
        removeformat code
        `,

            menubar: false,
            images_upload_url: '/admin/tiny/upload',
            images_upload_credentials: true,
            /* Chọn ảnh từ máy */
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',

            file_picker_callback: function(cb) {
                const input = document.createElement('input');
                input.type = 'file';
                input.accept = 'image/*';

                input.onchange = function() {
                    const file = this.files[0];
                    const reader = new FileReader();

                    reader.onload = function() {
                        cb(reader.result, {
                            title: file.name
                        });
                    };

                    reader.readAsDataURL(file);
                };

                input.click();
            }

        });
    </script>
    <script>
        document.getElementById('uploadAlbum').addEventListener('change', function() {
            const preview = document.getElementById('preview-album');
            preview.innerHTML = '';

            Array.from(this.files).forEach(file => {
                if (!file.type.startsWith('image/')) return;

                const col = document.createElement('div');
                col.className = 'col-6 col-md-4 col-lg-3';

                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = 'img-fluid ';

                col.appendChild(img);
                preview.appendChild(col);
            });
        });
    </script>
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
            $('.select2-multiple').select2();

            $('.select2-multiple').on('change', function() {
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
