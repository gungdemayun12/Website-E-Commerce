<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerProfilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;






Route::get('home', [ProductController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'all'])->name('products.all');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('produk.show');
Route::prefix('cart')->group(function () {
    Route::get('/', [ProductController::class, 'showCart'])->name('cart.show');
    Route::post('/add/{id}', [ProductController::class, 'addToCart'])->name('cart.add');
    Route::post('/update', [ProductController::class, 'updateCart'])->name('cart.update');
    Route::post('/update-size', [ProductController::class, 'updateSize'])->name('cart.updateSize');
    Route::delete('/remove', [ProductController::class, 'removeFromCart'])->name('cart.remove');
});


    Route::post('/review/store', [ProductController::class, 'storeReview'])->name('reviews.store');
    Route::post('/reviews/{id}/vote', [ProductController::class, 'voteReview'])->name('reviews.vote');



Route::middleware('auth:customer')->group(function () {


    Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/process', [ProductController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/checkout/remove', [ProductController::class, 'removeFromCheckout'])->name('checkout.remove');
    Route::get('/checkout/success', [ProductController::class, 'checkoutSuccess'])->name('checkout.success');     

    
    Route::post('/direct-checkout', [ProductController::class, 'directCheckout'])->name('cart.direct');
    Route::get('/cart-to-checkout', [ProductController::class, 'checkoutFromCart'])
        ->name('cart.checkout');

   
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('order.index');

    Route::get('/orders/{id}/receipt', [OrderController::class, 'receipt'])
        ->name('customer.orders.receipt');

    Route::get('/pesan/create/{id}', [OrderController::class, 'create'])
        ->name('order.create');

    Route::post('/pesan/store', [OrderController::class, 'store'])
        ->name('order.store');

  
    Route::get('/customer/profile', [CustomerProfilController::class, 'index'])
        ->name('customer.profile');

    Route::get('/customer/profile/edit', [CustomerProfilController::class, 'edit'])
        ->name('customer.profile.edit');

    Route::put('/customer/profile/update/{id}', [CustomerProfilController::class, 'memberUpdate'])
        ->name('customer.profile.update');
});


    
    Route::get('/customer/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
    Route::post('/customer/login', [CustomerAuthController::class, 'loginCustomer']);
    Route::get('/customer/register', [CustomerAuthController::class, 'showRegister']);
    Route::post('/customer/register', [CustomerAuthController::class, 'register']);
    Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');





    Route::middleware(['auth'])->prefix('dashboard')->group(function () {

  
    Route::get('/', [DashboardController::class, 'dashboard'])
        ->name('dashboard.home');

  
    Route::get('/produk', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/store', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::post('/update/{id}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/produk/{id}', [DashboardController::class, 'destroyProduk'])->name('dashboard.produk.destroy');
    Route::post('/update-stock/{id}', [ProductController::class, 'updateStock'])->name('dashboard.update-stock');
    Route::post('/bulk-delete', [ProductController::class, 'bulkDelete'])->name('dashboard.bulk-delete');
    Route::get('/export', [ProductController::class, 'export'])->name('dashboard.export');



 
    Route::get('/kategori', [CategoryController::class, 'index'])
    ->name('dashboard.kategori.index');
    
    Route::get('/kategori/create', [CategoryController::class, 'create'])
        ->name('dashboard.kategori.create');
    
    Route::post('/kategori/store', [CategoryController::class, 'store'])
        ->name('dashboard.kategori.store');
    
    Route::get('/kategori/edit/{id}', [CategoryController::class, 'edit'])
        ->name('dashboard.kategori.edit');
    
    Route::put('/kategori/{id}', [CategoryController::class, 'update'])
        ->name('dashboard.kategori.update');
    
    Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])
        ->name('dashboard.kategori.destroy');



   
    Route::get('/pesanan', [DashboardController::class, 'pesanan'])
        ->name('dashboard.pesanan');

    Route::get('/pesanan/riwayat', [DashboardController::class, 'riwayatPesanan'])
        ->name('dashboard.pesanan.riwayat');

    Route::get('/pesanan/create', [DashboardController::class, 'createPesanan'])
        ->name('dashboard.pesanan.create');

    Route::post('/pesanan/store', [DashboardController::class, 'storePesanan'])
        ->name('dashboard.pesanan.store');

    Route::get('/pesanan/{id}/edit', [DashboardController::class, 'editPesanan'])
        ->name('dashboard.pesanan.edit');

    Route::put('/pesanan/{id}', [DashboardController::class, 'updatePesanan'])
        ->name('dashboard.pesanan.update');

    Route::delete('/pesanan/{id}', [DashboardController::class, 'destroyPesanan'])
        ->name('dashboard.pesanan.destroy');

    Route::get('/orders/{id}/receipt', [OrderController::class, 'receipt'])
        ->name('orders.receipt');




 

    Route::get('/review', [DashboardController::class, 'reviewIndex'])
        ->name('dashboard.review.index');

    Route::post('/review/{id}/reply', [DashboardController::class, 'reviewReply'])
        ->name('dashboard.review.reply');

    Route::delete('/review/{id}', [DashboardController::class, 'reviewDestroy'])
        ->name('dashboard.review.destroy');

    Route::post('/review/{id}/ban-user', [DashboardController::class, 'reviewBanUser'])
        ->name('dashboard.review.banUser');
        


  
    Route::get('/member', [DashboardController::class, 'memberIndex'])
        ->name('dashboard.member.index');

    Route::post('/member/store', [DashboardController::class, 'memberStore'])
        ->name('dashboard.member.store');

    Route::put('/member/{id}/update', [DashboardController::class, 'memberUpdate'])
        ->name('dashboard.member.update');

    Route::delete('/member/{id}', [DashboardController::class, 'memberDestroy'])
        ->name('dashboard.member.destroy');

    Route::post('/member/{id}/verify', [DashboardController::class, 'memberVerify'])
        ->name('dashboard.member.verify');

    Route::post('/member/{id}/change-type/{type}', [DashboardController::class, 'memberChangeType'])
        ->name('dashboard.member.change-type');



    Route::get('/admin', [DashboardController::class, 'adminIndex'])
        ->name('dashboard.admin.index');

    Route::post('/admin/store', [DashboardController::class, 'adminStore'])
        ->name('dashboard.admin.store');

    Route::put('/admin/{id}/update', [DashboardController::class, 'adminUpdate'])
        ->name('dashboard.admin.update');

    Route::delete('/admin/{id}', [DashboardController::class, 'adminDestroy'])
        ->name('dashboard.admin.destroy');

    Route::post('/admin/{id}/change-status/{status}', [DashboardController::class, 'adminChangeStatus'])
        ->name('dashboard.admin.changeStatus');

    Route::post('/admin/{id}/reset-password', [DashboardController::class, 'adminResetPassword'])
        ->name('dashboard.admin.resetPassword');


    
    Route::get('/pendapatan', [DashboardController::class, 'pendapatan'])
        ->name('dashboard.pendapatan');

    Route::get('/pendapatan/chart', [DashboardController::class, 'pendapatanChart'])
        ->name('dashboard.pendapatan.chart');


    Route::get('/pendapatan/export-excel', [DashboardController::class, 'exportPendapatanExcel'])
        ->middleware('auth')
        ->name('pendapatan.export.excel');
});







    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');











