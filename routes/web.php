<?php

use App\Http\Controllers\Cms\master\PpdbSettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cms\UserController;
use App\Http\Controllers\Cms\UserLevelController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\NominalAdministrasiController;

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

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect()->route('ppdb');
});

// user view
Route::get('/ppdb', [FrontController::class, 'informasi'])->name('ppdb');
Route::get('/ppdb/pendaftaran', [FrontController::class, 'pendaftaran']);
Route::post('/ppdb/pendaftaran', [FrontController::class, 'storePendaftaran']);

Route::middleware('auth')->group(function () {
    Route::get('/cms/dashboard', function () {
        return view('cms.dashboard');
    })->name('cmsDashboard');

    // route grup prefix cms
    Route::prefix('cms')->group(function () {
        // --setting--
        // route grup prefix user
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('cmsUser');
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{id}', [UserController::class, 'detail']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::put('/{id}/update-active', [UserController::class, 'updateActive']);
            Route::delete('/{id}', [UserController::class, 'delete']);
        });
        // route grup prefix user-level
        Route::prefix('user-level')->group(function () {
            Route::get('/', [UserLevelController::class, 'index'])->name('cmsUserLevel');
            Route::post('/', [UserLevelController::class, 'store']);
            Route::get('/{id}', [UserLevelController::class, 'detail']);
            Route::put('/{id}', [UserLevelController::class, 'update']);
            Route::delete('/{id}', [UserLevelController::class, 'delete']);
            Route::get('/{id}/setting', [UserLevelController::class, 'setting'])->name('cmsUserLevel.setting');
            Route::post('/{id}/setting', [UserLevelController::class, 'updateSetting']);
        });


        // --master--
        // route grup prefix master
        Route::prefix('master')->group(function () {
            // route grup prefix ppdb
            Route::prefix('ppdb')->group(function () {
                Route::get('/setting', [PpdbSettingController::class, 'index'])->name('cmsPpdbSetting');
                Route::post('/setting', [PpdbSettingController::class, 'store']);
                Route::get('/setting/{id}', [PpdbSettingController::class, 'detail']);
                Route::put('/setting/{id}', [PpdbSettingController::class, 'update']);
                Route::delete('/setting/{id}', [PpdbSettingController::class, 'delete']);

                Route::get('/administrasi', [NominalAdministrasiController::class, 'index'])->name('cmsNominalAdministrasi');
                Route::post('/administrasi', [NominalAdministrasiController::class, 'store']);
                Route::get('/administrasi/{id}', [NominalAdministrasiController::class, 'detail']);
                Route::put('/administrasi/{id}', [NominalAdministrasiController::class, 'update']);
                Route::delete('/administrasi/{id}', [NominalAdministrasiController::class, 'delete']);
            });
        });
    });


   



    Route::get('/cms/blank-space', function () {
        return view('cms.blank-space');
    })->name('cmsBlankSpace');

    Route::get('/cms/components', function () {
        return view('cms.components');
    })->name('cmsComponents');
});


