<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Permissions Routes
    Route::get('/permissions', [PermissionController::class, 'index'])
    ->middleware('permission:view')
    ->name('permissions.index');

    Route::get('/permissions/create', [PermissionController::class, 'create'])
    ->middleware('permission:create')
    ->name('permissions.create');

    Route::post('/permissions', [PermissionController::class, 'store'])
    ->middleware('permission:create')
    ->name('permissions.store');

    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])
    ->middleware('permission:edit')
    ->name('permissions.edit');

    Route::put('/permissions/{id}', [PermissionController::class, 'update'])
    ->middleware('permission:edit')
    ->name('permissions.update');

    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])
    ->middleware('permission:delete')
    ->name('permissions.destroy');

    // Roles Routes
    Route::get('/roles', [RoleController::class, 'index'])
    ->middleware('permission:view')
    ->name('roles.index');

    Route::get('/roles/create', [RoleController::class, 'create'])
    ->middleware('permission:create')
    ->name('roles.create');

    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');

    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])
    ->middleware('permission:edit')
    ->name('roles.edit');

    Route::put('/roles/{id}', [RoleController::class, 'update'])
    ->middleware('permission:edit')
    ->name('roles.update');

    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
    ->middleware('permission:delete')
    ->name('roles.destroy');


    //Users Routes
    Route::get('/users', [UserController::class, 'index'])
    ->middleware('permission:view-users')
    ->name('users.index');

    Route::get('/users/{id}/edit', [UserController::class, 'edit'])
    ->middleware('permission:edit')
    ->name('users.edit');

    Route::put('/users/{id}', [UserController::class, 'update'])
    ->middleware('permission:assign-role')
    ->name('users.update');


});

require __DIR__.'/auth.php';
