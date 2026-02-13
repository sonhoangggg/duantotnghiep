{{--
Sao chép toàn bộ trang này.
Tạo view tạo trong folder admin vào view/admin/ten folder/index....
vd: view/admin/products/index.balde.php
--}}





@extends('layouts.admin')

{{-- Tiêu đề trang --}}
@section('title', 'Danh sách biến thể sản phẩm')



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
            <a href="{{ route('admin.san-pham.bien-the.them', $sanPham->slug) }}" class="btn btn-success mb-3">Tạo biến
                thể</a><br>

            <div class="card">
                <div class="car-body p-2">
                    @if ($thuoc_tinhs->isEmpty())
                        <a class="btn btn-success"
                            href="{{ route('admin.san-pham.them-thuoc-tinh-cho-san-pham', $sanPham->slug) }}">Thêm</a>
                    @else
                        <table class="table table-hover">
                            <thead class="">
                                <tr>
                                    <th>Tên thuộc tính</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($thuoc_tinhs as $thuoc_tinh_id => $ten)
                                    <tr>

                                        <td>

                                            <span class="text-success">{{ $ten }}</span>


                                        </td>

                                        <td>
                                            <div class="gap-4 d-flex">
                                                <div>
                                                    <a
                                                        href="{{ route('admin.san-pham.sua-thuoc-tinh-san-pham', [$sanPham->slug, $thuoc_tinh_id]) }}">
                                                        <span class="  ri ri-pencil-fill fs-3"></span></a>
                                                </div>
                                                <div>
                                                    <form
                                                        action="{{ route('admin.san-pham.xoa-thuoc-tinh-ssan-pham', [$sanPham->slug, $thuoc_tinh_id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit"
                                                            onclick="return confirm('Bạn chắc muốn xóa chứ')"
                                                            class="btn btn-link p-0 border-0">
                                                            <span class="ri ri-delete-bin-6-line fs-3"></span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach




                            </tbody>
                        </table>
                        <a class="btn btn-outline-success m-2"
                            href="{{ route('admin.san-pham.them-thuoc-tinh-cho-san-pham', $sanPham->slug) }}">Thêm thuộc
                            tính</a>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title py-0 "> {{ $sanPham->ten }}


                    </h4>
                </div>
                <div class="card-body">

                    <div class="responsive-table-plugin">
                        <div class="table-rep-plugin">
                            <div class="table-responsive" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table  table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th data-priority="1">Sku</th>
                                            <th data-priority="3">Giá bán</th>
                                            <th data-priority="3">Số lượng</th>
                                            <th data-priority="6">Thumbnail</th>
                                            <th>Giá trị thuộc tính</th>
                                            <th>Trạng thái</th>
                                            <th data-priority="6">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($bienThes as $key => $bienThe)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td>{{ $bienThe->sku }}</td>
                                                <td>
                                                    @if ($bienThe->gia_ban === null)
                                                        {{ $bienThe->gia_goc }}
                                                    @else
                                                        <span
                                                            class="text-decoration-line-through text-muted">{{ number_format($bienThe->gia_goc, 0, ',', '.') }}
                                                            đ</span><br><span
                                                            class="fw-bold">{{ number_format($bienThe->gia_ban, 0, ',', '.') }}
                                                            đ</span>
                                                    @endif
                                                </td>
                                                <td>{{ $bienThe->so_luong }}</td>
                                                <td><img src="/storage/{{ $bienThe->anh_bien_the }}" alt="Thumbnail"
                                                        width="50">
                                                </td>
                                                <td>
                                                    @foreach ($bienThe->bienTheThuocTinhs as $bienTheThuocTinh)
                                                        {{ $bienTheThuocTinh->thuocTinh->ten }} :
                                                        {{ $bienTheThuocTinh['ten_hien_thi'] }} <br>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @switch($bienThe->trang_thai)
                                                        @case('hien')
                                                            <span class="badge bg-success">Hiển thị</span>
                                                        @break

                                                        @case('an')
                                                            <span class="badge bg-warning">Ẩn</span>
                                                        @break

                                                        @case('cap_nhap')
                                                            <span class="badge bg-danger">Cập nhập</span>
                                                        @break

                                                        @case('ngung_ban')
                                                            <span class="badge bg-secondary">Ngừng bán</span>
                                                        @break
                                                    @endswitch

                                                <td class="pe-4 text-star">
                                                    <div class="btn-group gap-4 col-12">
                                                        {{-- sửa bien the --}}
                                                        <a href="{{ route('admin.san-pham.bien-the.sua', $bienThe->id) }}">
                                                            <span class="ri ri-pencil-fill fs-3"></span></a>
                                                        <form method="post" action="{{route('admin.san-pham.bien-the.xoa',$bienThe->id)}}">
                                                            @csrf
                                                            <button type="submit"
                                                                onclick="return confirm('Bạn chắc muốn xóa chứ')"
                                                                class="btn btn-link p-0 border-0">
                                                                <span class="ri ri-delete-bin-6-line fs-3"></span>
                                                            </button>
                                                        </form>

                                                    </div class="col-12">

                                                </td>
                                            </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div> <!-- end .table-responsive -->

                            </div> <!-- end .table-rep-plugin-->
                        </div> <!-- end .responsive-table-plugin-->

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
        {{-- Js viết ở đây nha --}}
    @endpush
