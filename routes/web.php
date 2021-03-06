<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Exports\ProductExport;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

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

Route::get('admin/kelola_barang', [App\Http\Controllers\ProductController::class, 'index'])
    ->name('admin.product')
    ->middleware('is_admin');

Route::post('admin/kelola_barang', [ProductController::class, 'add_product'])
    ->name('admin.product.submit')
    ->middleware('is_admin');

Route::get('admin/kelola_barang', [ProductController::class, 'index'])
    ->name('admin.kelola_barang')
    ->middleware('is_admin');

Route::get('admin/ajaxadmin/dataProduct', [ProductController::class, 'getDataProduct']);
Route::post('admin/kelola_barang', [ProductController::class, 'add_product'])
    ->name('admin.product.submit')
    ->middleware('is_admin');

Route::delete('admin/kelola_barang/delete', [ProductController::class, 'delete_product'])
    ->name('admin.product.delete')
    ->middleware('is_admin');

//Route Categories
Route::get('admin/kategori', [CategoriesController::class, 'index'])
    ->name('admin.kategori')
    ->middleware('is_admin');
Route::post('admin/kategori/submit', [CategoriesController::class, 'add_categories'])
    ->name('admin.kategori.submit')
    ->middleware('is_admin');
//route edit categories
Route::patch('admin/kategori/update', [CategoriesController::class, 'update_categories'])
    ->name('admin.kategori.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataCategories/{id}', [CategoriesController::class, 'getDataCategories']);

//route delete categories
Route::delete('admin/kategori/delete', [CategoriesController::class, 'delete_categories'])
    ->name('admin.kategori.delete')
    ->middleware('is_admin');


//ROUTE UTAMA BRANDS
Route::get('admin/merek', [App\Http\Controllers\BrandsController::class, 'index'])
    ->name('admin.merek')
    ->middleware('is_admin');

//route tambah brands
Route::post('admin/merek', [BrandsController::class, 'add_brand'])
    ->name('admin.brand.submit')
    ->middleware('is_admin');

//route edit brands
Route::patch('admin/merek/update', [BrandsController::class, 'update_brands'])
    ->name('admin.brand.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataBrands/{id}', [BrandsController::class, 'getDataBrands']);

//route delete brands
Route::delete('admin/merek/delete', [BrandsController::class, 'delete_brands'])
    ->name('admin.brand.delete')
    ->middleware('is_admin');


//Route Product
Route::get('admin/kelola_barang', [App\Http\Controllers\ProductController::class, 'index'])
    ->name('admin.product')
    ->middleware('is_admin');

Route::post('admin/kelola_barang', [ProductController::class, 'add_product'])
    ->name('admin.product.submit')
    ->middleware('is_admin');
//route edit categories
Route::patch('admin/kelola_barang/update', [ProductController::class, 'update_product'])
    ->name('admin.product.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataCategories/{id}', [ProductController::class, 'getDataProduct']);

//route delete categories
Route::delete('admin/kelola_barang/delete', [ProductController::class, 'delete_product'])
    ->name('admin.product.delete')
    ->middleware('is_admin');


//Route User
Route::get('admin/user', [ProfileController::class, 'index'])
->name('admin.user')
->Middleware('is_admin');

//route tambah
Route::post('admin/user', [ProfileController::class, 'add_user'])
->name('admin.user.submit')
->middleware('is_admin');

//route edit
Route::patch('admin/user/update', [ProfileController::class, 'update_user'])
->name('admin.user.update')
->middleware('is_admin');
Route::get('admin/ajaxadmin/dataUser/{id}', [ProfileController::class, 'getDataUser']);

//route delete
Route::delete('admin/user/delete', [ProfileController::class, 'destroy'])
->name('admin.user.delete')
->middleware('is_admin');


Route::get('admin/laporan/keluar', [App\Http\Controllers\ExportController::class, 'index'])
    ->name('admin.product.export')
    ->middleware('is_admin');

Route::get('admin/laporan/masuk', [App\Http\Controllers\ImportController::class, 'index'])
    ->name('admin.product')
    ->middleware('is_admin');

Route::get('admin/laporan/keluar/export', [App\Http\Controllers\AdminController::class, 'export'])
    ->name('admin.product.export')
    ->middleware('is_admin');

Route::post('admin/laporan/masuk/import', [AdminController::class, 'import'])
    ->name('admin.product.import')
    ->middleware('is_admin');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
