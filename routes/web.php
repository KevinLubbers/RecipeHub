<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\IngredientsController;

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
Route::middleware('guest')->group(function () {
    Route::get('/', [PagesController::class, 'getHome']);
    Route::get('dashboard', [PagesController::class, 'getDashboard']);
    Route::get('edit', [PagesController::class, 'getEdit']);

    Route::get('login', [PagesController::class, 'getLogin'])->name('login');
    Route::post('login', [PagesController::class, 'storeLogin'])->name('login.store');
    
    Route::get('register', [PagesController::class, 'getRegister'])->name('register');
    Route::post('register', [PagesController::class, 'storeRegister'])->name('register.store');
    
    Route::post('copy', [PagesController::class, 'copyFlash'])->name('copy.post');
    Route::get('search/guest', [SearchController::class, 'guestSearch'])->name('guest.search');
});

Route::middleware('auth')->group(function(){
    Route::resource('recipes', RecipesController::class);

    Route::resource('ingredients', IngredientsController::class);
    Route::post('ingredients/{id}/create', [IngredientsController::class, 'create'])->name('create.ingred');

    Route::delete('logout', [PagesController::class, 'destroyLogin'])->name('login.destroy');

    Route::post('copyAuth', [RecipesController::class, 'copyFlashAuth'])->name('copy.auth');
    Route::get('search/user', [SearchController::class, 'userSearch'])->name('user.search');
});

