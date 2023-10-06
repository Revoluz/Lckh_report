<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LckhUserController;
use App\Http\Controllers\LckhAdminController;
use App\Http\Controllers\RoleAdminController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\WorkPlaceController;
use App\Http\Controllers\RecapDataAdminController;
use App\Http\Controllers\ListUploadLCKHdminController;
use App\Http\Controllers\ListUploadLCKHAdminController;

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
        Route::put('/admin/change-password/{user}', [UserAdminController::class, 'changePassword'])->name('change.Password');
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
    });
    Route::middleware(['User'])->group(function () {
        Route::resource('/user/lckh', LckhUserController::class)->names(['index' => 'lckhUser.index', 'create' => 'lckhUser.create', 'store' => 'lckhUser.store', 'show' => 'lckhUser.show', 'edit' => 'lckhUser.edit', 'update' => 'lckhUser.update', 'destroy' => 'lckhUser.destroy']);
        Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    });
});
