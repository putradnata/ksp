
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\SimpananPokokController;
use App\Http\Controllers\SimpananWajibController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\JurnalUmumController;
use App\Http\Controllers\PenarikanController;
use App\Http\Controllers\SimpananKhususController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SisaHasilUsahaController;
use App\Http\Controllers\SukuBungaController;
use App\Http\Controllers\BukuBesarController;
use App\Http\Controllers\NeracaController;

Route::get('/', function () {
    // return view('auth.login');
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//protecc w/ auth
Route::middleware(['auth'])->group(function () {
    //protecc w/ ketua
    Route::middleware(['ketua'])->group(function () {
        //give 'ketua' prefix into url
        Route::prefix('ketua')->group(function () {
            //index ketua
                Route::get('/', function () {
                    return view('ketua.index');
                })->name('indexKetua');
        });
    });

    //protecc w/ admin
    Route::middleware(['admin'])->group(function () {
        //give 'admin' prefix into url
        Route::prefix('admin')->group(function () {

            //dashboard
            Route::get('/', [DashboardController::class, 'indexAdmin'])->name('dashboard.staff');

            //bunga
            Route::get('/bank-rates', [SimpananController::class, 'bankRates'])->name('simpanan.bankRates');

            //report
            Route::get('/simpanan-pokok/{id}', [SimpananPokokController::class, 'PrintReport'])->name('simpananPokok.report');
            Route::get('/simpanan-wajib/{id}', [SimpananWajibController::class, 'PrintReport'])->name('simpananWajib.report');
            Route::get('/simpanan-khusus/{id}', [SimpananKhususController::class, 'PrintReport'])->name('simpananKhusus.report');

            //sisa hasil usaha
            Route::get('/sisa-hasil-usaha',[SisaHasilUsahaController::class,'index'])->name('sisaHasilUsaha.index');
            Route::post('/sisa-hasil-usaha',[SisaHasilUsahaController::class,'SHUDateBased'])->name('sisaHasilUsaha.shu-dateBased');
            Route::post('/sisa-hasil-usaha/cetak',[SisaHasilUsahaController::class,'cetakSHU'])->name('sisaHasilUsaha.cetak');

            //buku besar
            Route::get('/buku-besar',[BukuBesarController::class,'index'])->name('bukuBesar.index');
            Route::post('/buku-besar',[BukuBesarController::class,'getAccountActivity'])->name('bukuBesar.show');

            //neraca
            Route::get('/neraca',[NeracaController::class,'index'])->name('neraca.index');
            Route::post('/neraca',[NeracaController::class,'getNeraca'])->name('neraca.show');

            //All Resource Controller
            Route::resources([
                'staff' => UserController::class, #Staff
                'anggota' => AnggotaController::class, #Anggota
                'akun' => AkunController::class, #Akun
                'simpanan' => SimpananController::class, #Simpanan
                'simpananPokok' => SimpananPokokController::class, #Simpanan Pokok
                'simpananWajib' => SimpananWajibController::class, #Simpanan Wajib
                'pinjaman' => PinjamanController::class, #Pinjaman
                'angsuran' => AngsuranController::class, #Angsuran
                'penarikan' => PenarikanController::class, #Penarikan
                'simpananKhusus' => SimpananKhususController::class, #Simpanan Khusus
                'jurnal-umum' => JurnalUmumController::class, #Jurnal Umum
                'sukuBunga' => SukuBungaController::class #Suku Bunga
            ]);
        });
    });
});
