{{--
Sao chép toàn bộ trang này.
Tạo view tạo trong folder admin vào view/admin/ten folder/index....
vd: view/admin/products/index.balde.php
--}}





@extends('layouts.admin')

{{-- Tiêu đề trang --}}
@section('title', 'default')



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

                    <div class="mb-3">
                        <form action="{{ route('admin.thuoc-tinh.gia-tri.cap-nhap', $gia_tri->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Giá trị thuộc tính :
                                    <span>{{ $gia_tri->thuocTinh->ten }}</span></label>
                                <input type="text" class="form-control w-50 mb-3" name="ten_hien_thi"
                                    value="{{ old('ten_hien_thi', $gia_tri->ten_hien_thi) }}" id=""
                                    aria-describedby="helpId" placeholder="" />
                                <span class="text-danger">{{ $errors->first('ten_hien_thi') }}</span>
                                @switch($gia_tri->thuocTinh->kieu)
                                    @case('mau')
                                        <input type="color" name="gia_tri" id="colorInput" value="{{ $gia_tri->gia_tri }}">
                                    @break

                                    @case('anh')
                                    <img class="w-50 img-thumbnail mb-3" src="{{Storage::url($gia_tri->gia_tri)}}" alt=""> <br>
                                    <input type="file" name="gia_tri" >
                                    @break

                                    @default
                                @endswitch
                            </div>
                            <button type="submit" class="btn btn-success">
                                Sửa
                            </button>
                        </form>

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
    {{-- Js viết ở đây nha --}}
@endpush
