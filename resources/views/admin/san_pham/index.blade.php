{{--
Sao chép toàn bộ trang này.
Tạo view tạo trong folder admin vào view/admin/ten folder/index....
vd: view/admin/products/index.balde.php
--}}





@extends('layouts.admin')

{{-- Tiêu đề trang --}}
@section('title', 'Danh sách sản phẩm')



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
            <a href="{{ route('admin.san-pham.them') }}" class="btn btn-success mb-3">Thêm sản phẩm</a>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title py-0">Danh sách sản phẩm</h4>
                </div>
                <div class="card-body">

                    <div class="responsive-table-plugin">
                        <div class="table-rep-plugin">
                            <div class="table-responsive" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-hover align-middle  ">
                                    <thead>
                                        <tr>
                                            <th class="p-0">STT</th>
                                            <th data-priority="1" class="p-0">Tên</th>
                                            <th data-priority="1" class="p-0">Sku</th>
                                            <th data-priority="3" class="p-0">Giá bán</th>
                                            <th data-priority="6" class="p-0">Thumbnail</th>
                                            <th data-priority="1" class="p-0">Trạng thái</th>
                                            <th data-priority="1" class="p-0">Số lượng</th>
                                            <th class="p-0 px-2 text-center"><i class=" ri-star-fill"></i></th>
                                            <th data-priority="" class="p-0">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($sanPhams as $key => $sanPham)
                                            <tr>
                                                <th class="p-0" scope="row">{{ $key + 1 }}</th>
                                                <td class="p-0"><a
                                                        href="{{ route('admin.san-pham.chi-tiet', $sanPham->slug) }}"
                                                        class="text-secondary">{{ $sanPham->ten }}</a></td>
                                                <td class="p-0">{{ $sanPham->sku }}</td>
                                                <td class="p-0">
                                                    @if ($sanPham->loai === 'bien_the')
                                                        <p class="fw-bold">
                                                            {{ number_format($sanPham->bienThes->min('gia_ban'), 0, ',', '.') }}đ
                                                        </p>
                                                    @else
                                                        @if ($sanPham->gia_ban !== null)
                                                            <p class="text-decoration-line-through text-muted m-0">
                                                                {{ number_format($sanPham->gia_goc, 0, ',', '.') }}đ
                                                            </p>
                                                            <p class="fw-bold m-0">
                                                                {{ number_format($sanPham->gia_ban, 0, ',', '.') }}đ</p>
                                                        @else
                                                            {{ number_format($sanPham->gia_goc, 0, ',', '.') }}đ
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="p-0"><img src="{{ Storage::url($sanPham->anh_chinh) }}" alt="Thumbnail"
                                                        width="50">
                                                </td>
                                                <td class="p-0">
                                                    @if ($sanPham->trang_thai)
                                                        <span class="badge bg-success">Hiển thị</span>
                                                    @else
                                                        <span class="badge bg-danger">Ẩn</span>
                                                    @endif
                                                </td>
                                                <td class="p-0">
                                                    {{ $sanPham->loai === 'bien_the' ? $sanPham->bienThes->sum('so_luong') : $sanPham->so_luong }}
                                                </td>
                                                <td class="p-0 text-center">
                                                    <a href="#">{!! $sanPham->noi_bat == 1 ? '<i class="ri-star-fill"></i>' : '<i class="ri-star-line"></i>' !!}</a>
                                                </td>
                                                <td class="fs-6 p-0">
                                                    <div class="btn-group gap-2 ">
                                                        <a href="{{ route('admin.san-pham.sua', $sanPham->slug) }}">
                                                            <span class="  ri ri-pencil-fill fs-3"></span></a>


                                                        <form method="post"
                                                            action="{{ route('admin.san-pham.xoa', $sanPham->slug) }}">
                                                            @csrf
                                                            <button type="submit"
                                                                onclick="return confirm('Bạn chắc muốn xóa chứ')"
                                                                class="btn btn-link p-0 border-0">
                                                                <span class="ri ri-delete-bin-6-line fs-3"></span>
                                                            </button>
                                                        </form>

                                                    </div><br>
                                                    <a
                                                        href="{{ route('admin.san-pham.bien-the.danh-sach', $sanPham->slug) }}">
                                                        @if ($sanPham->loai === 'bien_the')
                                                            Quản lý biến thể
                                                        @else
                                                            Tạo biến thể
                                                        @endif
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $sanPhams->links('pagination::bootstrap-5') }}
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
