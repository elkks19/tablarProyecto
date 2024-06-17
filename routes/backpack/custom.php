<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoriaCrudController;
use App\Http\Controllers\Admin\DivisaCrudController;
use App\Http\Controllers\Admin\MetodoPagoCrudController;
use App\Http\Controllers\Admin\RoleCrudController;
use App\Http\Controllers\Admin\OrdenCrudController;
use App\Http\Controllers\Admin\ProductoCrudController;
use App\Http\Controllers\Admin\ReviewCrudController;
use App\Http\Controllers\Admin\UserCrudController;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('categoria', 'CategoriaCrudController');
    Route::crud('divisa', 'DivisaCrudController');
    Route::crud('metodo-pago', 'MetodoPagoCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('orden', 'OrdenCrudController');
    Route::crud('producto', 'ProductoCrudController');
    Route::crud('review', 'ReviewCrudController');
    Route::crud('user', 'UserCrudController');

    // RUTAS PARA LA RESTAURACION DE LOS REGISTROS
    Route::get('categoria/{id}/restore', [CategoriaCrudController::class, 'restore']);
    Route::get('divisa/{id}/restore', [DivisaCrudController::class, 'restore']);
    Route::get('metodo-pago/{id}/restore', [MetodoPagoCrudController::class, 'restore']);
    Route::get('role/{id}/restore', [RoleCrudController::class, 'restore']);
    Route::get('orden/{id}/restore', [OrdenCrudController::class, 'restore']);
    Route::get('producto/{id}/restore', [ProductoCrudController::class, 'restore']);
    Route::get('review/{id}/restore', [ReviewCrudController::class, 'restore']);
    Route::get('user/{id}/restore', [UserCrudController::class, 'restore']);
}); // this should be the absolute last line of this file
