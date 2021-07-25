<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index')->name('home');

Route::get('/tentang', 'HomeController@tentang')->name('about');
Route::get('/kontak', 'HomeController@kontak')->name('contact');
Route::get('/syarat-dan-ketentuan', 'HomeController@faq')->name('faq');
Route::get('/get-kabupaten/{provinsi}', 'AuthController@getKabupatenByIdProv')->name('getKabupatenByIdProv');
Route::middleware(['guest:customer'])->group(function () {
    Route::get('/auth', 'AuthController@index')->name('auth');
    Route::post('/auth/register', 'AuthController@register')->name('auth_register');
    Route::post('/auth/login', 'AuthController@login')->name('auth_login');
});
Route::get('/auth/logout', 'AuthController@logout')->name('auth_logout')->middleware('user.auth');

Route::middleware(['guest:admin'])->group(function () {
    Route::get('/auth/admin', 'AuthController@indexAdmin')->name('auth_admin');
    Route::post('/auth/login/admin', 'AuthController@loginAdmin')->name('auth_login_admin');
});
Route::get('/auth/logout/admin', 'AuthController@logoutAdmin')
    ->name('auth_logout_admin')->middleware('admin.auth');

Route::get('/filter', 'HomeController@filter')->name('filter');
Route::get('/search', 'HomeController@search')->name('search');



//Customer
Route::get('/customer', 'CustomerController@index')->name('customer_index');
Route::prefix('/customer')->middleware(['user.auth'])->group(function () {
    Route::get('/profile/update', 'CustomerController@updateProfile')->name('update_profile_customer');
    Route::put('/profile/update', 'CustomerController@updateProfilePost')->name('update_profile_post_customer');

    Route::get('/pesanan/list', 'CustomerController@list')->name('pesanan_list_customer');
    Route::get('/pesanan/detail/{order}', 'CustomerController@detail')->name('pesanan_detail_customer');
    Route::put('/pesanan/detail/{order}', 'CustomerController@detailPost')->name('pesanan_detail_post_customer');

    Route::put('/pesanan/hapus-bukti-pembayaran/{order}', 'CustomerController@hapusBuktiPembayaran')->name('hapus_bukti_pembayaran');
    Route::put('/pesanan/batalkan-pesanan/{order}', 'CustomerController@batalkanPesanan')->name('batalkan_pesanan');
});

//Admin
Route::prefix('/admin')->middleware(['admin.auth'])->group(function () {
    Route::get('/', 'AdminController@index')->name('admin_index');
    Route::resource('/kategori', 'KategoriController');
    Route::resource('/produk', 'ProdukController');
    Route::resource('/user', 'UserController');
    Route::resource('/admin', 'SuperAdminController')->middleware('admin.super.auth');

    Route::get('/pesanan/list', 'OrderController@list')->name('pesanan_list');
    Route::get('/pesanan/detail/{order}', 'OrderController@detail')->name('pesanan_detail');
    Route::put('/pesanan/detail/{order}', 'OrderController@detailPost')->name('pesanan_detail_post');

    Route::get('/profile/update', 'AdminController@updateProfile')->name('update_profile');
    Route::put('/profile/update', 'AdminController@updateProfilePost')->name('update_profile_post');
});
