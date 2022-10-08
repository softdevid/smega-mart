<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\GaleriController;
use Illuminate\Support\Facades\Route;
use Cviebrock\EloquentSluggable\Services\SlugService;

// Routing

// Home Route
Route::get('/', [HomeController::class, 'index']);
Route::get('/products', [HomeController::class, 'product']);
Route::get('/products/{product:slug}', [HomeController::class, 'productDetail']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/gallery', [HomeController::class, 'gallery']);

// Auth Route
Route::get('/registration', [AuthController::class, 'indexRegistration'])->middleware('guest')->name('registration');
Route::post('/registration', [AuthController::class, 'registration']);
Route::get('/login', [AuthController::class, 'indexLogin'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

//route jumlah item keranjang
Route::get('/cartsum', [HomeController::class, 'cartsum']);
Route::get('/product/{slug}', [OrderController::class, 'detailProduct']);

//route customer
Route::middleware(['auth'])->group(function () {
  //route keranjang
  Route::resource('order', OrderController::class);
  Route::delete('/order/{id}', [OrderController::class],);
  Route::get('/cart', [HomeController::class, 'cart']);
  Route::get('/checkout', [OrderController::class, 'checkout']);

  //route checkout dan prosesnya
  Route::post('/pesan/{id}', [OrderController::class, 'pesan']);

  //profile
  Route::get('/profil', [HomeController::class, 'profil']);
  //ROute pesanan customer
  Route::get('/pesanan/diproses', [OrderController::class, 'diproses']);
  Route::get('/pesanan/dikemas', [OrderController::class, 'dikemas']);
  Route::get('/pesanan/dikirim', [OrderController::class, 'dikirim']);
  Route::get('/pesanan/selesai', [OrderController::class, 'selesai']);

  //route detail pesanan
  Route::get('/detail-pesanan/{noFaktur}', [OrderController::class, 'detailPesanan']);
});

// Routing Admin
Route::middleware(['auth'])->group(function () {

  Route::get('/dashboard', [AdminController::class, 'index']);

  //Route product
  Route::resource('/dashboard/products', BarangController::class);
  Route::get('/store', [BarangController::class, 'store']);
  Route::get('/dashboard/products/list', [BarangController::class, 'list'])->name('product.data');
  Route::get('/kasir-barcode-data', [KasirController::class, 'getBarcodeData'])->name('searchBarang');


  Route::resource('storage', StorageController::class);

  // //Route Gudang
  // Route::get('/stock-store/{id}', [StorageController::class, 'store']);
  // Route::post('stock-store/{id}', [StorageController::class, 'updateStore']);
  // Route::get('/stock-storage/{id}', [StorageController::class, 'storage']);

  //Route suplier, satuan, galleri
  Route::resource('suplier', SuplierController::class);
  Route::resource('unit', SatuanController::class);
  Route::resource('galleries', GaleriController::class);

  //Route User
  Route::resource('user', UserController::class);

  //Route Order
  Route::get('/orders', [OrderController::class, 'index']);
  Route::get('/detailProduct/{slug}', [OrderController::class, 'detailProduct'])->name('detailProduct');

  //Route kasir
  Route::resource('kasir', KasirController::class);

  //route penjualan kasir
  Route::post('/kasir/store', [KasirController::class, 'store'])->name('transaksi.store');
  Route::get('/kasir/detail/{noFakturJualan}', [KasirController::class, 'getDetailData'])->name('transaksi.detail');
  Route::post('/kasir/store/simpan', [KasirController::class, 'simpan'])->name('transaksi.simpan');

  //route pembelian admin
  Route::post('/admin/store', [StorageController::class, 'store'])->name('pembelian.store');
  Route::get('/admin/detail/{noFakturBeli}', [StorageController::class, 'getDetailData'])->name('pembelian.detail');
  Route::get('/admin/store/simpan', [StorageController::class, 'simpan'])->name('pembelian.simpan');

  Route::get('/session/forget', [KasirController::class, 'destroy'])->name('forget');

  Route::resource('laporan', LaporanController::class);

  Route::get('data', [BarangController::class, 'data'])->name('dataBarang');

  //route laporan
  Route::post('/laporan/date', [LaporanController::class, 'date']);


  //hapus cover gambar utama dan gambar lain
  // Route::delete('/deletecover/{barcode}', [BarangController::class, 'deletecover']);
  Route::delete('/deletecover/{barcode}', [BarangController::class, 'deletecover']);
  Route::delete('/deletegambar/{barcode}', [BarangController::class, 'deletegambar']);

  //slug
  Route::get('check_slug_supplier', function () {
    $slug = SlugService::createSlug(App\Models\Satuan::class, 'slug', request('namaSupplier'));
    return response()->json(['slug' => $slug]);
  });
  Route::get('check_slug_barang', function () {
    $slug = SlugService::createSlug(App\Models\Barang::class, 'slug', request('namaBarang'));
    return response()->json(['slug' => $slug]);
  });
});
