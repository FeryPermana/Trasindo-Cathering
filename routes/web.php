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

Auth::routes();


Route::prefix('merchant')->middleware(['auth', 'role.merchant'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\merchant\ProfileController::class, 'index'])->name('merchant.profile.index');
    Route::post('/profile/{id}', [App\Http\Controllers\merchant\ProfileController::class, 'update'])->name('merchant.profile.update');

    Route::get('/list-menu', [App\Http\Controllers\merchant\MenuController::class, 'index'])->name('merchant.menu.index');
    Route::get('/add-menu', [App\Http\Controllers\merchant\MenuController::class, 'create'])->name('merchant.menu.create');
    Route::post('/store-menu', [App\Http\Controllers\merchant\MenuController::class, 'store'])->name('merchant.menu.store');
    Route::get('/edit-menu/{id}/edit', [App\Http\Controllers\merchant\MenuController::class, 'edit'])->name('merchant.menu.edit');
    Route::post('/update-menu/{id}', [App\Http\Controllers\merchant\MenuController::class, 'update'])->name('merchant.menu.update');
    Route::delete('/delete-menu/{id}', [App\Http\Controllers\merchant\MenuController::class, 'delete'])->name('merchant.menu.delete');
});

Route::get('/', [App\Http\Controllers\customer\MenuController::class, 'index'])->name('customer.menu.index');

Route::middleware(['auth', 'role.customer'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\customer\ProfileController::class, 'index'])->name('customer.profile.index');
    Route::post('/profile/{id}', [App\Http\Controllers\customer\ProfileController::class, 'update'])->name('customer.profile.update');

    Route::get('/list-menu', [App\Http\Controllers\customer\MenuController::class, 'index'])->name('customer.menu.index');
});
