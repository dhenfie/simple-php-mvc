<?php
use System\Routing\Route;

Route::setNamespace('App\\Controllers\\');
Route::setError('ErrorController::error');

Route::add('/', 'HomeController::main');
Route::add('auth/login', 'AuthController::login');
Route::add('auth/logout', 'AuthController::logout');
