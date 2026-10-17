<?php

use Illuminate\Support\Facades\Route;
use App\Produk;
use App\StokBahan;
use App\Transaksi;

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
    $stats = [
        'produk_active' => 0,
        'stok_items' => 0,
        'stok_kritis' => 0,
        'transaksi_bulan' => 0,
        'pendapatan_bulan' => 0,
    ];

    try {
        $startOfMonth = now()->startOfMonth();

        $stats['produk_active'] = Produk::where('is_active', true)->count();
        $stats['stok_items'] = StokBahan::count();
        $stats['stok_kritis'] = StokBahan::whereIn('status', ['kritis', 'habis'])->count();
        $stats['transaksi_bulan'] = Transaksi::where('status', 'valid')
            ->whereBetween('tanggal', [$startOfMonth, now()])
            ->count();
        $stats['pendapatan_bulan'] = Transaksi::where('status', 'valid')
            ->where('tipe', 'pemasukan')
            ->whereBetween('tanggal', [$startOfMonth, now()])
            ->sum('total_harga');
    } catch (\Throwable $e) {
        // Keep defaults (0) if database/tables not ready.
    }

    return view('welcome', compact('stats'));
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

Route::middleware('auth')->group(function() {
    Route::resource('basic', 'BasicController');
    Route::get('/stok', 'StokBahanController@index')->name('stok.index');
    Route::get('/transaksi', 'TransaksiController@index')->name('transaksi.index');
    Route::get('/transaksi/create', 'TransaksiController@create')->name('transaksi.create');
    Route::post('/transaksi', 'TransaksiController@store')->name('transaksi.store');
    Route::get('/transaksi/{transaksi}', 'TransaksiController@show')->name('transaksi.show');
    Route::get('/laporan', 'LaporanController@index')->name('laporan.index');
    Route::get('/laporan/export/excel', 'LaporanController@exportExcel')->name('laporan.export.excel');
    Route::get('/laporan/export/pdf', 'LaporanController@exportPdf')->name('laporan.export.pdf');
    Route::get('/settings/theme', 'SettingsController@theme')->name('settings.theme');
});

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::resource('produk', 'ProdukController')->except(['show']);
    Route::get('/stok/create', 'StokBahanController@create')->name('stok.create');
    Route::post('/stok', 'StokBahanController@store')->name('stok.store');
    Route::get('/stok/{stok}/edit', 'StokBahanController@edit')->name('stok.edit');
    Route::put('/stok/{stok}', 'StokBahanController@update')->name('stok.update');
    Route::delete('/stok/{stok}', 'StokBahanController@destroy')->name('stok.destroy');
    Route::get('/stok/{stok}/restock', 'StokBahanController@restockForm')->name('stok.restock.form');
    Route::post('/stok/{stok}/restock', 'StokBahanController@restock')->name('stok.restock');
    Route::delete('/transaksi/{transaksi}', 'TransaksiController@destroy')->name('transaksi.destroy');
});
