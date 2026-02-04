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
            {{-- Nội dung nhét vào đây --}}
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
