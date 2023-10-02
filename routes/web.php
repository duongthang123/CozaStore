<?php

use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\Users\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController as ControllersMainController;
use App\Http\Controllers\MenuController as ControllersMenuController;
use App\Http\Controllers\ProductController as ControllersProductController;


Route::get('admin/users/login',[LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function() {

    Route::prefix('admin')->group(function() {
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);


        // menu
        Route::prefix('menus')->group(function() {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list',[MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::DELETE('destroy', [MenuController::class, 'destroy']);

        });
        //product

        Route::prefix('products')->group(function(){
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'index']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::DELETE('destroy', [ProductController::class, 'destroy']);
            
        });

        //Slider

        Route::prefix('sliders')->group(function(){
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
            
        });


        // upload

        Route::post('upload/services', [UploadController::class, 'store']);

        //Cart

        Route::get('customers', [AdminCartController::class, 'index']);
        Route::get('customers/view/{customer}', [AdminCartController::class, 'show']);
    });


});

Route::get('/', [ControllersMainController::class, 'index']);
Route::post('/services/load-product', [ControllersMainController::class, 'loadProduct']);
Route::get('danh-muc/{id}-{slug}.html', [ControllersMenuController::class, 'index']);
Route::get('san-pham/{id}-{slug}.html', [ControllersProductController::class, 'index']);
Route::post('add-cart', [CartController::class, 'index']);
Route::get('carts', [CartController::class, 'show']);
Route::post('update-cart', [CartController::class, 'update']);
Route::get('carts/delete/{id}', [CartController::class, 'remove']);
Route::post('carts', [CartController::class, 'addCart']);
Route::get('san-pham/quickView', [ControllersProductController::class, 'quickView']);