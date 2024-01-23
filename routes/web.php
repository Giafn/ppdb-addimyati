<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Cms\DashboardController;
use App\Http\Controllers\Cms\ListPendaftarController;
use App\Http\Controllers\Cms\PembayaranController;
use App\Http\Controllers\Cms\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Cms\Administrasi\KeringananController;
use App\Http\Controllers\Cms\Administrasi\NominalAdministrasiController;
use App\Http\Controllers\Cms\Master\PpdbSettingController;
use App\Http\Controllers\Cms\Master\JurusanController;
use App\Http\Controllers\Cms\Informasi\FaqController;
use App\Http\Controllers\Cms\Informasi\InfoPPDBController;
use App\Http\Controllers\Cms\System\UserController;
use App\Http\Controllers\Cms\System\UserLevelController;
use Maatwebsite\Excel\Facades\Excel;

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
    if (Auth::User()) {
        return redirect()->route('cmsDashboard');
    } else {
        return redirect()->route('ppdb');
    }
});

Route::get('/test-export', function () {
    return Excel::download(new \App\Exports\ExportPPDB(['tahun_ajaran' => null, 'gelombang' => null , 'is_all' => false]), 'test.xlsx');
});

Route::get('/test-view', function () {
    return view('export.data-asal-sekolah');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return redirect()->route('login');
    });
    Route::get('cms/login', [AuthenticatedSessionController::class, 'showLogin']);
    Route::post('cms/login', [AuthenticatedSessionController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
});

// user view
Route::get('/ppdb', [FrontController::class, 'informasi'])->name('ppdb');
Route::get('/ppdb/pendaftaran', [FrontController::class, 'pendaftaran']);
Route::get('/ppdb/flow-daftar', [FrontController::class, 'flowDaftar']);
Route::post('/ppdb/pendaftaran', [FrontController::class, 'storePendaftaran']);
Route::post('/ppdb/pendaftaran/sub-email', [FrontController::class, 'subEmail']);
Route::get('/ppdb/cek-data', [FrontController::class, 'indexCekData']);
Route::post('/ppdb/cek-data', [FrontController::class, 'cekData']);
Route::middleware('auth')->group(function () {  
    // route grup prefix cms
    Route::prefix('cms')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('cmsDashboard');
        Route::get('/dashboard/data', [DashboardController::class, 'data'])->name('cmsDashboard.data');
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

        Route::prefix('informasi')->group(function () {
            Route::get('/alur-pendaftaran', [InfoPPDBController::class, 'index'])->name('cmsAlurPendaftaran');
            Route::post('/alur-pendaftaran', [InfoPPDBController::class, 'storeOrUpdate']);
            Route::get('/alur-pendaftaran/{id}', [InfoPPDBController::class, 'detail']);
            Route::delete('/alur-pendaftaran/{id}', [InfoPPDBController::class, 'delete']);

            Route::get('/faq', [FaqController::class, 'index'])->name('cmsFaq');
            Route::post('/faq', [FaqController::class, 'storeOrUpdate']);
            Route::get('/faq/{id}', [FaqController::class, 'detail']);
            Route::delete('/faq/{id}', [FaqController::class, 'delete']);
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

                Route::get('/program-studi', [JurusanController::class, 'index'])->name('cmsProgramStudi');
                Route::post('/program-studi', [JurusanController::class, 'storeOrUpdate']);
                Route::get('/program-studi/{id}', [JurusanController::class, 'detail']);
                Route::delete('/program-studi/{id}', [JurusanController::class, 'delete']);
            });
        });

        Route::prefix('administrasi')->group(function () {
                Route::get('/normal', [NominalAdministrasiController::class, 'index'])->name('cmsNominalAdministrasi');
                Route::post('/normal', [NominalAdministrasiController::class, 'store']);
                Route::get('/normal/{id}', [NominalAdministrasiController::class, 'detail']);
                Route::put('/normal/{id}', [NominalAdministrasiController::class, 'update']);
                Route::delete('/normal/{id}', [NominalAdministrasiController::class, 'delete']);

                Route::get('/keringanan', [KeringananController::class, 'index'])->name('cmsKeringanan');
                Route::post('/keringanan', [KeringananController::class, 'upsert']);
                Route::get('/keringanan/{id}', [KeringananController::class, 'detail']);
                Route::delete('/keringanan/{id}', [KeringananController::class, 'delete']);
        });

        // --list pendaftar--
        Route::prefix('list-pendaftar')->group(function () {
            Route::get('/', [ListPendaftarController::class, 'index'])->name('cmsListPendaftar');
            Route::post('/', [ListPendaftarController::class, 'daftarManual']);
            Route::get('/{id}', [ListPendaftarController::class, 'detail']);
            Route::put('/{id}', [ListPendaftarController::class, 'update']);
            Route::delete('/{id}', [ListPendaftarController::class, 'delete']);
            Route::patch('/update/profile/{id}', [ListPendaftarController::class, 'updateProfile']);
            Route::patch('/update/akademik/{id}', [ListPendaftarController::class, 'updateAkademik']);
            Route::patch('/update/ortu/{id}', [ListPendaftarController::class, 'updateOrangTua']);
            Route::patch('/update/wali/{id}', [ListPendaftarController::class, 'updateWali']);
            Route::get('/export/excel', [ListPendaftarController::class, 'export']);
        });

        Route::prefix('pembayaran')->group(function () {
            Route::get('/', [PembayaranController::class, 'index'])->name('cmsPembayaran');
            Route::get('/{id}', [PembayaranController::class, 'showInfoAndHistory']);
            Route::post('/{id}', [PembayaranController::class, 'bayar']);
            Route::post('/{id}/total', [PembayaranController::class, 'setHarga']);
        });

        Route::prefix('export')->group(function () {
            Route::post('/lengkap', [PembayaranController::class, 'index'])->name('cmsPembayaran');
            Route::get('/{id}', [PembayaranController::class, 'showInfoAndHistory']);
            Route::post('/{id}', [PembayaranController::class, 'bayar']);
            Route::post('/{id}/total', [PembayaranController::class, 'setHarga']);
        });
    });

   



    Route::get('/cms/blank-space', function () {
        return view('cms.blank-space');
    })->name('cmsBlankSpace');

    Route::get('/cms/components', function () {
        return view('cms.components');
    })->name('cmsComponents');
});


