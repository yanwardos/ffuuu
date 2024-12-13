<?php

use App\Http\Controllers\ClothingController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    return view('landing');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');

// DATA USER
Route::prefix('user')->group(function () {
    // CRUD
    Route::get('all', [UserController::class, 'index'])->name('user.all');
    Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/{user}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/{user}/delete', [UserController::class, 'destroy'])->name('user.delete');
});

// DATA BAJU
Route::prefix('clothing')->group(function(){
    Route::get('all', [ClothingController::class, 'index'])->name('clothing.all');

    Route::get('create', [ClothingController::class, 'create'])->name('clothing.create');
    Route::post('create', [ClothingController::class, 'store'])->name('clothing.store');

    Route::get('/{clothing}', [ClothingController::class, 'show'])->name('clothing.show');
    Route::get('/{clothing}/edit', [ClothingController::class, 'edit'])->name('clothing.edit');
    Route::post('/{clothing}/update', [ClothingController::class, 'update'])->name('clothing.update');
    Route::post('/{clothing}/delete', [ClothingController::class, 'destroy'])->name('clothing.delete');
    
    Route::post('/{clothing}/preview/add', [ClothingController::class, 'storeImagePreview'])->name('clothing.preview.add');
    Route::post('/{clothing}/preview/delete', [ClothingController::class, 'deletePreview'])->name('clothing.preview.delete');

    Route::post('/{clothing}/fbx/add', [ClothingController::class, 'storeFbx'])->name('clothing.fbx.store');
    Route::post('/{clothing}/fbx/delete', [ClothingController::class, 'deleteFbx'])->name('clothing.fbx.delete');
    
});



Route::get('vars', function () { 
    foreach(User::all() as $user){
        dump($user->attributesToArray()); 
    }
});
