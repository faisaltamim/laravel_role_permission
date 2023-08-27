<?php

use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UserController;
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

Route::get( '/', function () {
    return view( 'welcome' );
} );

Auth::routes();

Route::get( 'home', [App\Http\Controllers\HomeController::class, 'index'] )->name( 'home' );

Route::prefix( 'admin' )->name( 'admin.' )->group( function () {
    Route::get( '', [DashboardController::class, 'index'] )->name( 'dashboard' );
    // set roles route
    Route::resource( 'roles', RolesController::class );
    // set User route
    Route::resource( 'users', UserController::class );

    //set admin routes
    // -------------------
    // admin login route
    Route::get( 'login', [LoginController::class, 'showLoginRoute'] )->name( 'login' );
    // admin login submit route
    Route::post( 'login-submit', [LoginController::class, 'login'] )->name( 'login.submit' );
    // admin logout submit route
    Route::post( 'logout-submit', [LoginController::class, 'logout'] )->name( 'logout.submit' );
} );
