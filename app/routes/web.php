<?php
use App\Core\Route\Router as Route;
use App\Controllers\GoogleController;

Route::get('/google/login',[GoogleController::class,'index'])->name('google_login')->middleware('checkLogin');
Route::get('/google/user',[GoogleController::class,'home'])->name('home_page')->middleware('authCheck');
Route::get('/logout',[GoogleController::class,'logout'])->name('logout')->middleware('authCheck');

Route::get('/','start');

//Route::get('/google/user',[GoogleController::class,'profile'])->name('home_page')->middleware('authCheck');
// use this route if you are storing user data in database