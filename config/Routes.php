<?php
use System\Routing\Route;

// set namespace controller
Route::setNamespace('App\\Controllers\\');

// register ErrorController untuk mengatur halaman 404
Route::setError('ErrorController::error');

// petakan route
Route::add('/', 'HomeController::main');
Route::add('auth/login', 'AuthController::login');
Route::add('auth/logout', 'AuthController::logout');
