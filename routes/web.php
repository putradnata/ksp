
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
            Route::get('/', function () {
                return view('admin.index');
            })->name('indexAdmin');

            // Route::get('/index-admin', [UserController::class, 'index'])->name('staff.index');
            // Route::get('/create-admin', 'admin/staff.create')->name('staff.create');
            // Route::post('/insert-admin', [UserController::class, 'store'])->name('staff.store');

            //All Resource Controller
            Route::resources([
                'staff' => UserController::class, #Staff
                'anggota' => AnggotaController::class, #Anggota
                'akun' => AkunController::class, #Akun
                'simpanan' => SimpananController::class, #Simpanan
                'simpananPokok' => SimpananPokokController::class, #Simpanan Pokok
                'simpananWajib' => SimpananWajibController::class, #Simpanan Wajib
                'pinjaman' => PinjamanController::class, #Pinjaman
                'angsuran' => AngsuranController::class #Angsuran
            ]);
        });
    });
});
