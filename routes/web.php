<?php

use App\Http\Controllers\Admin\BienTheSanPhamController;
use App\Http\Controllers\Admin\GiaTriThuocTinhController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\ThuocTinhController;
use App\Http\Controllers\TinyUploadContrller;
use Illuminate\Support\Facades\Route;


// Route Client

// Home Page : url = "/"
Route::get('/', function () {
    return view('client.home.index');
});

Route::prefix('shop')->name('shop.')->group(function () {

    // List products : Url = "shop/"
    Route::get('/', function () {
        return view('client.products.index');
    });

    // Detail product : Url = "shop/products/"
    Route::get('products/{slug?}', function ($slug = null) {
        return view('client.products.show');
    });

    // List categories : Url = "shop/categories"
    Route::get('categories', function () {
        return view('client.categories.index');
    })->name('categories');

    // Carts : Url = "shop/carts"
    Route::get('carts', function () {
        return view('client.carts.index');
    })->name('carts');

    // Checkout : Url = "shop/checkout"
    Route::get('checkout', function () {
        return view('client.checkout.index');
    })->name('checkout');

    // compare : Url = "shop/compare"
    Route::get('compare', function () {
        return view('client.compare.index');
    })->name('compare');

    // List Coupons  : Url = "shop/coupons"
    Route::get('coupons', function () {
        return view('client.coupons.index');
    })->name('coupons');
});


// Posts
Route::prefix('posts')->name('posts.')->group(function () {

    // List Post : Url = "post/"
    Route::get('/', function () {
        return view('client.posts.index');
    });

    // Post detail  : Url = "post/show/"
    Route::get('show/{slug?}', function ($slug = null) {
        return view('client.posts.show');
    });
});


Route::prefix('account')->name('account.')->group(function () {

    // Profile : Url = "account/profile/"
    Route::get('profile', function () {
        return view('client.profile.index');
    });

    // Orders :  Url = "account/orders/"
    Route::get('orders', function () {
        return view('client.orders.index');
    });
});


// Login  :  Url = "login/"
Route::get('login', function () {
    return view('auth.login.index');
})->name('login');

// Register :  Url = "register/"
Route::get('register', function () {
    return view('auth.register.index');
})->name('register');

// Reset password :  Url = "reset-password/"
Route::get('reset-password', function () {
    return view('auth.reset-password.index');
})->name('reset-password');













// Route admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('tiny/upload', [TinyUploadContrller::class, 'upload'])->name('tiny-upload');

    Route::get('/', function () {
        return  view('admin.dashboard.index');
    });


    // Trang mặc mặc định để viết nội dung
    Route::get('default', function () {
        return view('admin.default.index');
    });

    // Route Thuộc tính
    Route::prefix('thuoc-tinh')->name('thuoc-tinh.')->group(function () {
        Route::get('/', [ThuocTinhController::class, 'index'])->name('/');
        Route::get('them', [ThuocTinhController::class, 'create'])->name('them');
        Route::post('luu', [ThuocTinhController::class, 'add'])->name('luu');
        Route::get('sua/{id}', [ThuocTinhController::class, 'edit'])->name('sua');
        Route::post('cap-nhap/{id}', [ThuocTinhController::class, 'update'])->name('cap-nhap');
        Route::post('xoa/{id}', [ThuocTinhController::class, 'delete'])->name('xoa');

        Route::prefix('gia-tri')->name('gia-tri.')->group(function () {
            Route::get('cau-hinh/{id}', [GiaTriThuocTinhController::class, 'index'])->name('cau-hinh');
            Route::post('them/{id}', [GiaTriThuocTinhController::class, 'store'])->name('them');
            Route::get('sua/{id}', [GiaTriThuocTinhController::class, 'edit'])->name('sua');
            Route::post('cap-nhap/{id}', [GiaTriThuocTinhController::class, 'update'])->name('cap-nhap');
            Route::post('xoa/{id}', [GiaTriThuocTinhController::class, 'destroy'])->name('xoa');
        });
    });

    // Route Sản phẩm
    Route::prefix('san-pham')->name('san-pham.')->group(function () {

        Route::get('/', [SanPhamController::class, 'index'])->name('/');
        Route::get('them', [SanPhamController::class, 'create'])->name('them');
        Route::post('tao', [SanPhamController::class, 'store'])->name('tao');
        Route::get('sua/{slug}',[SanPhamController::class,'edit'])->name('sua');
        Route::post('cap-nhap/{slug}',[SanPhamController::class,'update'])->name('cap-nhap');
        Route::post('xoa/{slug}', [SanPhamController::class, 'delete'])->name('xoa');
        Route::get('chi-tiet/{slug}', [SanPhamController::class, 'show'])->name('chi-tiet');

        // Route Biến thể sản phẩm
        Route::prefix('bien-the')->name('bien-the.')->group(function () {
            Route::get('/{slug}', [BienTheSanPhamController::class, 'dsBienThe'])->name('danh-sach');
            Route::get('them/{slug}', [BienTheSanPhamController::class, 'themBienThe'])->name('them');
            Route::post('luu/{slug}', [BienTheSanPhamController::class, 'luuBienThe'])->name('luu');
            Route::get('sua/{id}', [BienTheSanPhamController::class, 'suaBienThe'])->name('sua');
            Route::post('cap-nhap/{id}', [BienTheSanPhamController::class, 'capNhapBienThe'])->name('cap-nhap');
            Route::post('xoa/{id}',[BienTheSanPhamController::class,'xoaBienThe'])->name('xoa');
        });

        // Route Thuộc tính sản phẩm
        Route::get('them-thuoc-tinh-cho-san-pham/{slug}', [SanPhamController::class, 'themThuocTinhChoSanPham'])->name('them-thuoc-tinh-cho-san-pham');
        Route::post('luu-thuoc-tinh-san-pham/{slug}', [SanPhamController::class, 'luuThuocTinhSanPham'])->name('luu-thuoc-tinh-san-pham');
        Route::get('sua-thuoc-tinh-san-pham/{slug}/{id}', [SanPhamController::class, 'suaThuocTinhSanPham'])->name('sua-thuoc-tinh-san-pham');
        Route::post('cap-nhap-thuoc-tinh-san-pham/{slug}', [SanPhamController::class, 'capNhapThuocTinhSanPham'])->name('cap-nhap-thuoc-tinh-san-pham');
        Route::post('xoa-thuoc-tinh-ssan-pham/{slug}/{id}', [SanPhamController::class, 'xoaThuocTinhSanPham'])->name('xoa-thuoc-tinh-ssan-pham');



    });
});
