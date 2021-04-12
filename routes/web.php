
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
            //index admin
            // Route::get('/', function () {
            //     return view('admin.index');
            // })->name('indexAdmin');

            Route::get('/', [DashboardController::class, 'indexAdmin'])->name('dashboard.staff');
            Route::get('/bank-rates', [SimpananController::class, 'bankRates'])->name('simpanan.bankRates');

            //sisa hasil usaha
            Route::get('/sisa-hasil-usaha',[SisaHasilUsahaController::class,'index'])->name('sisaHasilUsaha.index');
            Route::post('/sisa-hasil-usaha',[SisaHasilUsahaController::class,'SHUDateBased'])->name('sisaHasilUsaha.shu-dateBased');
            Route::post('/sisa-hasil-usaha/cetak',[SisaHasilUsahaController::class,'cetakSHU'])->name('sisaHasilUsaha.cetak');

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
                'jurnal-umum' => JurnalUmumController::class #Jurnal Umum
            ]);
        });
    });
});
