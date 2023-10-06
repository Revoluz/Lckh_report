<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LckhAdminController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\ListUploadLCKHdminController;
use App\Http\Controllers\ListUploadLCKHAdminController;
use App\Http\Controllers\RecapDataAdminController;
use App\Http\Controllers\RoleAdminController;
use App\Http\Controllers\WorkPlaceController;

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
        Route::resource('/admin/lckh', LckhAdminController::class)->names(['index' => 'lckh.index', 'create' => 'lckh.create', 'store' => 'lckh.store', 'show' => 'lckh.show', 'edit' => 'lckh.edit', 'update' => 'lckh.update', 'destroy' => 'lckh.destroy']);
        Route::resource('/admin/user', UserAdminController::class)->names(['index' => 'user.index', 'create' => 'user.create', 'store' => 'user.store', 'update' => 'user.update', 'destroy' => 'user.destroy']);
        // Route::get('admin/user/{nip}', [
        //     UserAdminController::class, 'show'
        // ])->name('user.show');
        Route::get('admin/user/{nip}', [UserAdminController::class, 'show'])->name('user.show');
        Route::get('admin/profile', [UserAdminController::class, 'profile'])->name('user.profile');
        Route::get('admin/user/{nip}/edit', [UserAdminController::class, 'edit'])->name('user.edit');
        Route::put('admin/change-password/{user}', [UserAdminController::class, 'changePassword'])->name('change.Password');
        Route::get('admin/list-upload-lckh', [ListUploadLCKHAdminController::class, 'index'])->name('listLCKH.index');
        Route::get('/admin/list-upload-lckh/{lckh}', [ListUploadLCKHAdminController::class, 'show'])->name('listLCKH.show');
        Route::get('/admin/list-upload-lckh/filter', [ListUploadLCKHAdminController::class, 'filter'])->name('listLCKH.filter');
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
    });
});
