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
            <form action="{{ route('admin.san-pham.bien-the.cap-nhap', $bien_the->id) }}" method="post"
                enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Thuộc tính sản phẩm</h4>

                    </div>
                    <div class="card-body">


                        @foreach ($bien_the->sanPham->thuocTinhs as $thuoc_tinh)
                            <label class="form-label">{{ $thuoc_tinh->ten }}</label>

                            @php
                                $giaTriDaChon = $bien_the->bienTheThuocTinhs
                                    ->where('thuoc_tinh_id', $thuoc_tinh->id)
                                    ->pluck('id')
                                    ->first();
                            @endphp

                            <select class="form-control" name="gia_tri[{{ $thuoc_tinh->id }}]">

                                <option value="">-- Chọn --</option>

                                @foreach ($thuoc_tinh->giaTri as $gia_tri)
                                    <option value="{{ $gia_tri->id }}"
                                        {{ $giaTriDaChon == $gia_tri->id ? 'selected' : '' }}>
                                        {{ $gia_tri->ten_hien_thi }}
                                    </option>
                                @endforeach

                            </select>
                        @endforeach

                        @error('gia_tri.*')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('gia_tri_thuoc_tinh.*')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if ($errors->has('to_hop_gia_tri'))
                            <div class="text-danger">
                                {{ $errors->first('to_hop_gia_tri') }}
                            </div>
                        @endif
                        {{-- @dd($bien_the->bienTheThuocTinhs) --}}
                    </div>

                </div>
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card  ">
                            <div class="card-header py-2">
                                <h4 class="header-title">Ảnh biến thể</h4>
                            </div>
                            <div class="card-body row">
                                <img src="{{ Storage::url($bien_the->anh_bien_the) }}" style="width:50%" class="mb-3"
                                    alt="">
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
                                        <input type="text" value="{{ $bien_the->sku }}" class="form-control"
                                            name="sku_bien_the" id="">
                                        @error('sku_bien_the')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="mb-3 col-6">
                                        <label for="" class="form-lable">Số lượng</label>
                                        <input type="text" value="{{ $bien_the->so_luong }}" class="form-control"
                                            name="so_luong" id="">
                                        @error('so_luong')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="" class="form-lable">Giá thông thường</label>
                                        <input type="text" value="{{ $bien_the->gia_goc }}" class="form-control"
                                            name="gia_tt" id="">
                                        @error('gia_tt')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="" class="form-lable">Giá khuyến mãi</label>
                                        <input type="text" value="{{ $bien_the->gia_ban }}" class="form-control"
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
                                <div class="mt-3">
                                    @foreach ($thong_sos as $thong_so)
                                        <div class="mb-3">
                                            <label class="form-label">{{ $thong_so->ten }}</label>

                                            @php
                                                $giaTri = $bien_the->thongSos->where('id', $thong_so->id)->first()
                                                    ?->pivot->gia_tri;
                                            @endphp

                                            <input type="text" class="form-control"
                                                name="thong_so[{{ $thong_so->id }}]"
                                                value="{{ old("thong_so.$thong_so->id", $giaTri) }}">
                                        </div>
                                    @endforeach

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-success mb-3">Cập nhập </button>
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
@endpush
