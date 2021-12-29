<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ScraperAmazon;
use App\Http\Controllers\{
  DashboardController,
  GeneralSettingsController,
  MenuController,
  MyProfileController,
  ProductController,
  RoleController,
  UserController,  
  SearchController,
};

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        //'laravelVersion' => Application::VERSION,
        //'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');



Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    //Route::get('/dashboard', function () { return Inertia::render('Dashboard'); })->name('dashboard');
    
    //Route::get('/dashboard', function () { return Inertia::render('Dashboard'); })->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/scrapin', [DashboardController::class, 'get'])->name('scrapin');
    
    Route::get('/monitor', [ScraperAmazon::class, 'scraper']);

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::get('/{product}/show', [ProductController::class, 'show'])->name('products.show');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
    
    Route::prefix('menus')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('menus');
        Route::get('/children/{menuId}', [MenuController::class, 'children']);
        Route::post('/store', [MenuController::class, 'store'])->name('menus.store');  
        Route::put('/{menu}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('/{id}', [MenuController::class,'destroy'])->name('menus.destroy');
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::get('/{role}/show', [RoleController::class, 'show'])->name('roles.show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');  
        Route::post('/store', [RoleController::class, 'store'])->name('roles.store');  
        Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/{id}', [RoleController::class,'destroy'])->name('roles.destroy');
    });

    Route::prefix('myprofile')->group(function () {
      Route::get('/edit', [MyProfileController::class, 'edit'])->name('myprofile.edit');      
      Route::put('/', [MyProfileController::class, 'update'])->name('myprofile.update');      
      Route::put('/password', [MyProfileController::class, 'updatePassword'])->name('myprofile-password.update');
    });
    
    Route::prefix('settings')->group(function () {
        Route::get('/', [GeneralSettingsController::class, 'edit'])->name('settings');    
        Route::put('/', [GeneralSettingsController::class, 'update'])->name('settings.update');
    });
    
    Route::prefix('users')->middleware(['role:admin'])->group(function () {    
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/show', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    
    Route::get('search', SearchController::class)->name('search');    
    
});

Route::prefix('error')->group(function () {
    Route::get('/', function(){ 
        abort(500);
    });
    Route::get('/custom', function(){ 
        throw new \App\Exceptions\CustomException('Levi Strauss', 501);
    });    
});
