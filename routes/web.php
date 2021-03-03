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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/staging',function(){
//     return view('layouts.template');
// });

//protecc w/ auth
Route::middleware(['auth'])->group(function () {
    //protecc w/ ketua
    Route::middleware(['ketua'])->group(function () {
        //give 'ketua' prefix into url
        Route::prefix('ketua')->group(function () {
            //index admin
            Route::get('/',function(){
                return view('ketua.index');
            })->name('indexKetua');
        });
    });

    //protecc w/ admin
    Route::middleware(['admin'])->group(function () {
        //give 'admin' prefix into url
        Route::prefix('admin')->group(function () {
            //index admin
            Route::get('/',function(){
                return view('admin.index');
            })->name('indexAdmin');
        });
    });
});
