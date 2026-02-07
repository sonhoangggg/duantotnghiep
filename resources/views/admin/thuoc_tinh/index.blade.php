@extends('layouts.admin')

{{-- Tiêu đề trang --}}
@section('title', 'Danh sách thuộc tính')



@section('content')
    <div class="container-fluid">
        <div>
            <div class="row ">
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
            <div class="main-content">


                <button class="btn btn-success mb-3">
                    <a href="{{ route('admin.thuoc-tinh.them') }}">
                        <span class="text-white">Thêm thuộc tính mới</span>
                    </a>
                </button>
                @if (session('success'))
                    <div class="alert alert-primary ">{{ session('success') }}</div>
                @endif

                <div class="card ">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3 border-bottom-0 text-muted small fw-bold text-uppercase"
                                            style="width: 80px;">ID</th>
                                        <th class="py-3 border-bottom-0 text-muted small fw-bold text-uppercase">Tên
                                            thuộc tính</th>
                                        <th class="py-3 border-bottom-0 text-muted small fw-bold text-uppercase">Kiểu
                                        </th>
                                        <th class="py-3 border-bottom-0 text-muted small fw-bold text-uppercase">Giá trị
                                            hiện có</th>
                                        <th
                                            class="pe-4 py-3 border-bottom-0 text-muted small fw-bold text-uppercase text-star">
                                            Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($thuocTinhs as $index => $thuocTinh)
                                        <tr>
                                            <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="fw-bold">{{ $thuocTinh->ten }}</span>
                                                </div>
                                            </td>
                                            <td class="text-monospace text-secondary small">{{ $thuocTinh->kieu }}</td>
                                            <td>
                                                <div class="mb-1">
                                                    @foreach ($thuocTinh->giaTri as $giaTri)
                                                        <span
                                                            class="badge rounded-pill bg-light text-dark border me-1">{{ $giaTri->ten_hien_thi }}</span>
                                                    @endforeach
                                                </div>
                                                <div>
                                                    <span><a class="fs-6"
                                                            href="{{ route('admin.thuoc-tinh.gia-tri.cau-hinh', $thuocTinh->id) }}">Cấu
                                                            hình thuộc tính</a></span>
                                                </div>
                                            </td>
                                            <td class="pe-4 text-star">
                                                <div class="btn-group gap-4">
                                                    <a href="{{ route('admin.thuoc-tinh.sua', $thuocTinh->id) }}">
                                                        <span class="  ri ri-pencil-fill fs-3"></span></a>


                                                    <form method="post"
                                                        action="{{ route('admin.thuoc-tinh.xoa', $thuocTinh->id) }}">
                                                        @csrf
                                                        <button type="submit" onclick="return confirm('Bạn chắc muốn xóa chứ')" class="btn btn-link p-0 border-0">
                                                            <span class="ri ri-delete-bin-6-line fs-3"></span>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
        </div>



    </div> <!-- container -->

    </div>

@endsection




@push('css')
@endpush



@push('js')
@endpush
