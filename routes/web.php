<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/edit/{permissionId}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('/permissions/update/{permissionId}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/permissions', [PermissionController::class, 'destroy'])->name('permission.destroy');


    Route::get('/Roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/edit/{roleId}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/update/{roleId}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('role.destroy');


    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/article/edit/{artcleId}', [ArticleController::class, 'edit'])->name('article.edit');
    Route::post('/article/update/{articleId}', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/article', [ArticleController::class, 'destroy'])->name('article.destroy');
    

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('articles.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{userId}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/user/update/{userId}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user', [UserController::class, 'destroy'])->name('user.destroy');
});

require __DIR__ . '/auth.php';
