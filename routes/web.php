<?php

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
Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('/', function () {
        return  view('admin.dashboard.index');
    });


    // Trang mặc mặc định để viết nội dung
    Route::get('default',function(){
        return view('admin.default.index');
    });

});
