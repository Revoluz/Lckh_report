<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LckhUserController;
use App\Http\Controllers\LckhAdminController;
use App\Http\Controllers\RoleAdminController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\WorkPlaceController;
use App\Http\Controllers\UserDokumenController;
use App\Http\Controllers\DokumenAdminController;
use App\Http\Controllers\LckhPengawasController;
use App\Http\Controllers\UserPengawasController;
use App\Http\Controllers\RecapDataAdminController;
use App\Http\Controllers\LckhKepalaKantorController;
use App\Http\Controllers\UserKepalaKantorController;
use App\Http\Controllers\DocumentTypeAdminController;
use App\Http\Controllers\RecapDataPengawasController;
use App\Http\Controllers\ListUploadLCKHAdminController;
use App\Http\Controllers\RecapDataKepalaKantorController;
use App\Http\Controllers\ListUploadLCKHPengawasController;
use App\Http\Controllers\ListUploadLCKHKepalaKantorController;

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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticated');
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::middleware(['Administrator'])->group(function () {
        Route::resource('/admin/lckh', LckhAdminController::class)->names(['index' => 'lckhAdmin.index', 'create' => 'lckhAdmin.create', 'store' => 'lckhAdmin.store', 'show' => 'lckhAdmin.show', 'edit' => 'lckhAdmin.edit', 'update' => 'lckhAdmin.update', 'destroy' => 'lckhAdmin.destroy']);
        Route::resource('/admin/user', UserAdminController::class)->names(['index' => 'userAdmin.index', 'create' => 'userAdmin.create', 'store' => 'userAdmin.store', 'update' => 'userAdmin.update', 'destroy' => 'userAdmin.destroy']);
        // Route::get('admin/user/{nip}', [
        //     UserAdminController::class, 'show'
        // ])->name('user.show');
        Route::get('/admin/user/{nip}', [UserAdminController::class, 'show'])->name('userAdmin.show');
        Route::get('/admin/profile', [UserAdminController::class, 'profile'])->name('userAdmin.profile');
        Route::get('/admin/user/{nip}/edit', [UserAdminController::class, 'edit'])->name('userAdmin.edit');
        Route::put('/admin/change-password/{user}', [UserAdminController::class, 'changePassword'])->name('changeAdmin.Password');
        Route::get('/admin/list-upload-lckh', [ListUploadLCKHAdminController::class, 'index'])->name('listLCKHAdmin.index');
        Route::get('/admin/list-upload-lckh/{lckh}', [ListUploadLCKHAdminController::class, 'show'])->name('listLCKHAdmin.show');
        Route::get('/admin/list-upload-lckh/filter/lckh', [ListUploadLCKHAdminController::class, 'filter'])->name('listLCKHAdmin.filter');
        Route::get('/admin/rekap-data', [RecapDataAdminController::class, 'index'])->name('recapData.index');
        Route::resource('/admin/tempat-tugas', WorkPlaceController::class)
            ->names([
                'index' => 'workPlace.index',
                'create' => 'workPlace.create',
                'store' => 'workPlace.store',
                'show' => 'workPlace.show',
                'update' => 'workPlace.update',
                'destroy' => 'workPlace.destroy',
            ])->parameter('tempat-tugas', 'work_place');
        Route::get('/admin/role', [RoleAdminController::class, 'index'])->name('role.index');
        Route::get('/admin/role/{role}', [RoleAdminController::class, 'show'])->name('role.show');
        Route::resource(
            '/admin/document',
            DokumenAdminController::class
        );
        Route::get('/admin/document/download/{document}', [DokumenAdminController::class, 'downloadDocument'])->name('document.download');
        Route::get('/admin/document/filter/document', [DokumenAdminController::class, 'filterDocument'])->name('document.filter');
        Route::resource('/admin/document-type', DocumentTypeAdminController::class);
    });
    Route::middleware(['User'])->group(function () {
        Route::resource('/user/lckh', LckhUserController::class)->names(['index' => 'lckhUser.index', 'create' => 'lckhUser.create', 'store' => 'lckhUser.store', 'show' => 'lckhUser.show', 'edit' => 'lckhUser.edit', 'update' => 'lckhUser.update', 'destroy' => 'lckhUser.destroy']);
        Route::get('/user/profile', [
            UserController::class, 'profile'
        ])->name('user.profile');
        Route::put('/user/change-password/{user}', [UserController::class, 'changePassword'])->name('changeUser.Password');
        Route::get('/user/document', [UserDokumenController::class, 'index'])->name('documentUser.index');
        Route::get('/user/document/{document}', [UserDokumenController::class, 'show'])->name('documentUser.show');
        Route::get('/user/document/download/{document}', [UserDokumenController::class, 'downloadDocument'])->name('documentUser.download');
    });
    Route::middleware(['Pengawas'])->group(function () {
        Route::resource('/pengawas/lckh', LckhPengawasController::class)->names(['index' => 'lckhPengawas.index', 'create' => 'lckhPengawas.create', 'store' => 'lckhPengawas.store', 'show' => 'lckhPengawas.show', 'edit' => 'lckhPengawas.edit', 'update' => 'lckhPengawas.update', 'destroy' => 'lckhPengawas.destroy']);
        Route::get('/pengawas/list-upload-lckh', [ListUploadLCKHPengawasController::class, 'index'])->name('listLCKHPengawas.index');
        Route::get('/pengawas/list-upload-lckh/{lckh}', [ListUploadLCKHPengawasController::class, 'show'])->name('listLCKHPengawas.show');
        Route::get('/pengawas/list-upload-lckh/filter/lckh', [ListUploadLCKHPengawasController::class, 'filter'])->name('listLCKHPengawas.filter');
        Route::get('/pengawas/rekap-data', [RecapDataPengawasController::class, 'index'])->name('recapDataPengawas.index');
        Route::get('/pengawas/profile', [UserPengawasController::class, 'profile'])->name('userPengawas.profile');
        Route::put('/pengawas/change-password/{user}', [UserPengawasController::class, 'changePassword'])->name('changePengawas.Password');
    });
    Route::middleware(['Kepala kantor'])->group(function () {
        Route::resource('/kepala-kantor/lckh', LckhKepalaKantorController::class)->names(['index' => 'lckhKepalaKantor.index', 'create' => 'lckhKepalaKantor.create', 'store' => 'lckhKepalaKantor.store', 'show' => 'lckhKepalaKantor.show', 'edit' => 'lckhKepalaKantor.edit', 'update' => 'lckhKepalaKantor.update', 'destroy' => 'lckhKepalaKantor.destroy']);
        Route::get('/kepala-kantor/list-upload-lckh', [ListUploadLCKHKepalaKantorController::class, 'index'])->name('listLCKHKepalaKantor.index');
        Route::get('/kepala-kantor/list-upload-lckh/{lckh}', [ListUploadLCKHKepalaKantorController::class, 'show'])->name('listLCKHKepalaKantor.show');
        Route::get('/kepala-kantor/list-upload-lckh/filter/lckh', [ListUploadLCKHKepalaKantorController::class, 'filter'])->name('listLCKHKepalaKantor.filter');
        Route::get('/kepala-kantor/rekap-data', [RecapDataKepalaKantorController::class, 'index'])->name('recapDataKepalaKantor.index');
        Route::get('/kepala-kantor/profile', [UserKepalaKantorController::class, 'profile'])->name('userKepalaKantor.profile');
        Route::put('/kepala-kantor/change-password/{user}', [UserKepalaKantorController::class, 'changePassword'])->name('changeKepalaKantor.Password');
    });
});
