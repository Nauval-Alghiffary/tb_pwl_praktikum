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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'index'])
    ->name('admin.home')
    ->middleware('is_admin');

Route::get('admin/kelola_barang', 
[App\Http\Controllers\ProductController::class, 'index'])
    ->name('admin.product')
    ->middleware('is_admin');

Route::post('admin/kelola_barang', [ProductController::class, 'add_product'])
    ->name('admin.product.submit')
    ->middleware('is_admin');

Route::get('admin/barangs', [barangController::class, 'index'])
    ->name('admin.barangs')
    ->middleware('is_admin');

Route::post('admin/barangs', [barangController::class, 'store'])
    ->name('admin.barang.submit')
    ->middleware('is_admin');
Route::patch('admin/barangs/update', [barangController::class, 'update'])
    ->name('admin.barang.update')
    ->middleware('is_admin');

Route::get('admin/ajaxadmin/dataBuku/{id}', [barangController::class, 'getDataBuku']);
Route::delete('admin/barangs/delete', [barangController::class, 'destroy'])
    ->name('admin.barang.delete')
    ->middleware('is_admin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
