<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;




Route::get('login',[LoginController::class, 'create'])->name('login');
Route::post('login',[LoginController::class, 'authenticate']);
Route::post('logout',[LoginController::class, 'destroy'])->middleware('auth');



Route::middleware('auth')->group(function () {


Route::get('/', function () {

    return Inertia::render('Home');
    
    
});    


//Users Routes

Route::get('/users',[UserController::class,'index']);

Route::get('/users/create',[UserController::class,'create']);

Route::post('/users/create',[UserController::class,'store']);

Route::get('users/edit/{id}',[UserController::class,'edit']);

Route::put('users/edit/{id}',[UserController::class,'update']);

Route::delete('/users/delete/{id}',[UserController::class,'destroy']);


Route::get('/settings', function () {
    return Inertia::render('Settings');

    
});

 }); 