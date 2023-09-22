<?php

use App\Http\Controllers\InstructionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfilesController;

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
    Route::post('copyAuth', [RecipesController::class, 'copyFlashAuth'])->name('copy.auth');
    
    Route::resource('ingredients', IngredientsController::class);
    Route::get('ingredients/{id}/create', [IngredientsController::class, 'create'])->name('create.ingred');

    Route::delete('logout', [PagesController::class, 'destroyLogin'])->name('login.destroy');   

    Route::get('search/user', [SearchController::class, 'userSearch'])->name('user.search');
    
    Route::get('profile', [ProfilesController::class, 'index'])->name('profile.index');
    Route::delete('profile/delete', [ProfilesController::class, 'deleteAccount'])->name('profile.destroy');
    Route::put('profile/update-email', [ProfilesController::class, 'updateEmail'])->name('profile.email');
    Route::put('profile/update-username', [ProfilesController::class, 'updateUsername'])->name('profile.user');
    Route::put('profile/update-password', [ProfilesController::class, 'updatePassword'])->name('profile.password');

});

