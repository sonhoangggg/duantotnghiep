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
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header py-2">
                            <h4 class="header-title">Thông tin</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-lable">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="" id="">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-lable">Sku</label>
                                <input type="text" class="form-control" name="" id="">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header py-2">
                            <h4 class="header-title">Mô tả ngắn</h4>
                        </div>
                        <div class="card-body">
                            <textarea rows="3" id="moTaNgan"></textarea>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header py-2">
                            <h4 class="header-title">Mô tả</h4>
                        </div>
                        <div class="card-body">
                            <textarea id="mytextarea"></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-header py-2">
                            <h4 class="header-title">Xuất bản</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 d-flex justify-content-between ">
                                <button class="btn btn-success">Xuất bản</button>
                                <button class="btn btn-outline-success">Lưu nháp</button>
                            </div>

                            <div class="form-check form-switch">
                                <label for="" class="form-check-lable">Sản phẩm nổi bật</label>
                                <input type="checkbox" class="form-check-input " name="" id="">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header py-2">
                            <h4 class="header-title">Ảnh chính sản phẩm</h4>
                        </div>
                        <div class="card-body row">
                            <label for="chonAnh" class="w-100 text-center border border-dashed p-1    cursor-pointer ">
                                <i class="ri-upload-cloud-2-line fs-1"></i>
                                <p class="mb-0">Click để chọn tệp</p>
                            </label>
                            <input type="file" class="form-control d-none" id="chonAnh" accept="image/*">
                            <div id="preview" class="mt-3 p-0">
                                <img src="" alt="" class="img-fluid d-none">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header py-2">
                            <h4 class="header-title">Album ảnh sản phẩm</h4>
                        </div>
                        <div class="card-body row">
                            <label for="uploadAlbum" class="w-100 text-center border border-dashed p-1    cursor-pointer ">
                                <p class="mb-0">Click để chọn tệp</p>
                            </label>
                            <input type="file" multiple class="form-control d-none" id="uploadAlbum" accept="image/*">
                            <div id="preview-album" class="row mt-3 g-2 py-0">
                                <img src="" alt="" class="img-fluid d-none">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div> <!-- container -->

    </div>

@endsection




@push('css')
    {{-- Css viết ở đây nha --}}
@endpush



@push('js')
    <script src="https://cdn.tiny.cloud/1/dzxe6fk2z4sikdvqeb1bpq0m0k7rir7gtshf2uwjcja7ov87/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
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
@endpush
