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
            <a href="{{ route('admin.san-pham.them-bien-the', $sanPham->slug) }}" class="btn btn-success mb-3">Tạo biến thể</a>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title py-0">Biến thể sản phẩm: {{ $sanPham->ten }}</h4>
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
                                                        {{$bienThe->gia_goc}}
                                                    @else
                                                       <span class="text-decoration-line-through text-muted">{{ number_format($bienThe->gia_goc, 0, ',', '.') }} đ</span><br><span class="fw-bold">{{ number_format($bienThe->gia_ban, 0, ',', '.') }} đ</span>
                                                    @endif
                                                </td>
                                                <td>{{ $bienThe->so_luong }}</td>
                                                <td><img src="{{ $bienThe->anh_bien_the }}" alt="Thumbnail" width="50">
                                                </td>
                                                <td>
                                                    @foreach ($bienThe->bienTheThuocTinhs as $bienTheThuocTinh)
                                                        {{ $bienTheThuocTinh->thuocTinh->ten }} :
                                                        {{ $bienTheThuocTinh['ten_hien_thi'] }} <br>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @if ($bienThe->trang_thai)
                                                        <span class="badge bg-success">Hiển thị</span>
                                                    @else
                                                        <span class="badge bg-danger">Ẩn</span>
                                                    @endif
                                                <td class="pe-4 text-star">
                                                    <div class="btn-group gap-4 col-12">
                                                        <a href="#">
                                                            <span class="  ri ri-pencil-fill fs-3"></span></a>


                                                        <form method="post" action="#">
                                                            @csrf
                                                            <button type="submit"
                                                                onclick="return confirm('Bạn chắc muốn xóa chứ')"
                                                                class="btn btn-link p-0 border-0">
                                                                <span class="ri ri-delete-bin-6-line fs-3"></span>
                                                            </button>
                                                        </form>

                                                    </div class="col-12">
                                                    {{-- <a href="{{ route('admin.san-pham.quan-ly-bien-the', $bienThe->slug) }}">Quản lý biến thể</a> --}}
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                                {{-- {{ $sanPhams->links('pagination::bootstrap-5') }} --}}
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
