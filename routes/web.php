<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::view('/register','auth.register')->name('register');

Route::post('/register',[App\Http\Controllers\Auth\AuthController::class,'register'])
    ->name('register.store');

Route::view('/login','Auth.login')->name('login');
Route::post('/login',
    [App\Http\Controllers\Auth\AuthController::class,'login']
)->name('login.store');