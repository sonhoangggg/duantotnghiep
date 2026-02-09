<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="index.html" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/admin/assets/images/logo.png') }}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/admin/assets/images/logo-sm.png') }}" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="index.html" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('assets/admin/assets/images/logo-dark.png') }}" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/admin/assets/images/logo-sm.png') }}" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">



            <li class="side-nav-item">
                <a href="index.html" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span class="badge bg-success float-end">9+</span>
                    <span> Dashboard </span>
                </a>
            </li>
 
            {{-- Danh mục --}}
          <li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#danhMuc" class="side-nav-link">
        <i class="ri-folder-line"></i>
        <span> Danh mục </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="danhMuc">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ route('admin.danh-muc.index') }}">Danh sách</a>
            </li>
            <li>
                <a href="{{ route('admin.danh-muc.create') }}">Thêm</a>
            </li>
            <li>
                <a href="{{ route('admin.danh-muc.trash') }}">Thùng rác</a>
            </li>
        </ul>
    </div>
</li>



           {{-- Thương hiệu --}}
<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#thuongHieu" class="side-nav-link">
        <i class="ri-store-2-line"></i>
        <span> Thương hiệu </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="thuongHieu">
        <ul class="side-nav-second-level">
            <li>
                <a href="{{ route('admin.thuong-hieu.index') }}">Danh sách</a>
            </li>
            <li>
                <a href="{{ route('admin.thuong-hieu.create') }}">Thêm</a>
            </li>
            <li>
                <a href="{{ route('admin.thuong-hieu.trash') }}">Thùng rác</a>
            </li>
        </ul>
    </div>
</li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#thuocTinh" aria-expanded="false"
                    aria-controls="thuocTinh" class="side-nav-link">
                    <i class="ri-group-2-line"></i>
                    <span> Thuộc tính </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="thuocTinh">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('admin.thuoc-tinh./')}}">Danh sách</a>
                        </li>
                        <li>
                            <a href="{{route('admin.thuoc-tinh.them')}}">Thêm</a>
                        </li>
                        <li>
                            <a href="#"><span class="ri ri-delete-bin-6-line"> </span>Thùng rác</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sanPham" aria-expanded="false"
                    aria-controls="sanPham" class="side-nav-link">
                    <i class=" ri-product-hunt-line"></i>
                    <span> Sản phẩm </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sanPham">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{route('admin.san-pham./')}}">Danh sách</a>
                        </li>
                        <li>
                            <a href="{{route('admin.san-pham.them')}}">Thêm</a>
                        </li>
                        <li>
                            <a href="#"><span class="ri ri-delete-bin-6-line"> </span>Thùng rác</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
