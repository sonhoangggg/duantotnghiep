{{--
Sao chép toàn bộ trang này.
Tạo view tạo trong folder admin vào view/admin/ten folder/index....
vd: view/admin/products/index.balde.php
--}}





@extends('layouts.admin')

{{-- Tiêu đề trang --}}
@section('title', 'Cấu Hình Thuộc Tính')



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
            <div class="mb-3">
                @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Thêm giá trị thuộc tính <span class="text-primary">{{ $thuocTinh->ten }}</span>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.thuoc-tinh.gia-tri.them', $thuocTinh->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 w-50">
                            <label for="" class="form-label">Tên hiển thị</label>
                            <input type="text" name="ten" class="form-control" id="">
                            @error('ten')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($thuocTinh->kieu === 'mau')
                            <div class="mb-3">
                                <label class="form-label">Giá trị</label><br>
                                <input type="color" name="gia_tri" class="form-control" style="width:60px;">
                            </div>
                        @elseif ($thuocTinh->kieu === 'anh')
                            <div class="mb-3 w-50">
                                <label class="form-label">Giá trị</label><br>
                                <input type="file" name="gia_tri" class="form-control">
                            </div>
                        @elseif ($thuocTinh->kieu === 'chuoi')
                        @endif
                        <button class="btn btn-success">Thêm</button>
                    </form>

                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Danh sách giá trị</h4>
                    <p class="text-muted mb-0">
                        Add <code>.table-hover</code> to enable a hover state on table rows within a
                        <code>&lt;tbody&gt;</code>.
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-hover  align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class=" border-bottom-0 text-muted small fw-bold text-uppercase"
                                        style="width: 80px;">STT</th>
                                    <th class=" border-bottom-0 text-muted small fw-bold text-uppercase">Tên</th>
                                    <th class=" border-bottom-0 text-muted small fw-bold text-uppercase w-50" >Giá trị</th>
                                    <th class="  border-bottom-0 text-muted small fw-bold text-uppercase text-star">Thao tác
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($thuocTinh->giaTri as $key => $value)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->ten_hien_thi }}</td>
                                        @if ($thuocTinh->kieu === 'mau')
                                            <td><input class="border-0" type="color" value="{{ $value->gia_tri }}"
                                                    disabled></td>
                                        @elseif ($thuocTinh->kieu === 'anh')
                                            <td class=" align-middle">
                                                <img src="{{ $value->gia_tri }}" class="img-thumbnail" width="80"
                                                    alt="">
                                            </td>
                                        @elseif ($thuocTinh->kieu === 'chuoi')
                                            <td></td>
                                        @endif
                                        <td class="pe-4 text-star">
                                            <div class="btn-group gap-4">
                                                <a href="#">
                                                    <span class="  ri ri-pencil-fill fs-3"></span></a>


                                                <form method="post"
                                                    action="#">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Bạn chắc muốn xóa chứ')"
                                                        class="btn btn-link p-0 border-0">
                                                        <span class="ri ri-delete-bin-6-line fs-3"></span>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>



    </div> <!-- container -->

    </div>

@endsection




@push('css')
    {{-- Css viết ở đây nha --}}
@endpush



@push('js')
    {{-- Js viết ở đây nha --}}
@endpush
