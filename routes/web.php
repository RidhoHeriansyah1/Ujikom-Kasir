<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporankController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/proses', [LoginController::class, 'prosesLogin'])->name('login.proses')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Produk
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/create-produk', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/create-produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});


/*
|--------------------------------------------------------------------------
| Pelanggan
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/create-pelanggan', [PelangganController::class, 'create'])->name('pelanggan.create');
Route::post('/create-pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::get('/pelanggan/{id}', [PelangganController::class, 'edit'])->name('pelanggan.edit');
Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
});


/*
|--------------------------------------------------------------------------
| Petugas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
Route::get('/create-petugas', [PetugasController::class, 'create'])->name('petugas.create');
Route::post('/create-petugas', [PetugasController::class, 'store'])->name('petugas.store');
Route::get('/petugas/{id}', [PetugasController::class, 'edit'])->name('petugas.edit');
Route::put('/petugas/{id}', [PetugasController::class, 'update'])->name('petugas.update');
Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');
});



/*
|--------------------------------------------------------------------------
|Transaksi
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'petugas'])->group(function () {

Route::get('/kasir', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/kasir/produk', [TransaksiController::class, 'getProduk'])->name('transaksi.getProduk');
Route::post('/keranjang', [TransaksiController::class, 'keranjang'])->name('transaksi.keranjang');
Route::post('/pembayaran', [TransaksiController::class, 'pembayaran'])->name('transaksi.pembayaran');
Route::delete('/keranjang/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.hapus-keranjang');
});


/*
|--------------------------------------------------------------------------
|Laporan
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function (){
Route::get('/struk/{id}', [TransaksiController::class, 'struk'])->name('transaksi.struk');
Route::post('/tambah-stok', [LaporanController::class, 'tambahStok'])->name('stok.create');
Route::get('/stok-masuk', [LaporanController::class, 'stokMasuk'])->name('stok.masuk');
Route::post('/stok-masuk/search/', [LaporanController::class, 'search'])->name('stok.search');
Route::get('/stok-keluar', [LaporanController::class, 'stokKeluar'])->name('stok.keluar');
Route::post('/stok-keluar/search/', [LaporanController::class, 'stokKeluarSearch'])->name('stok.keluar.search');
Route::get('/laporan-transaksi', [LaporanController::class, 'laporanTransaksi'])->name('laporan.transaksi');
Route::post('/laporan-transaksi/search/', [LaporanController::class, 'transaksiSearch'])->name('transaksi.search');
});


/*
|--------------------------------------------------------------------------
|diskon
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('/diskon', [DiskonController::class, 'index'])->name('diskon.index');
    Route::post('/diskon', [DiskonController::class, 'store'])->name('diskon.store');
    Route::put('/diskon/{id}', [DiskonController::class, 'update'])->name('diskon.update');
    Route::delete('/diskon/{id}', [DiskonController::class, 'destroy'])->name('diskon.destroy');
});
