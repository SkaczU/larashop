<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OrderController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', [HomeController::class, 'about']);

Route::group(['middleware' => 'guest'], function () {   

    
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
    Route::get('/logout', function () {
        return view('welcome');
    });

});



Route::group(['middleware' => 'auth'], function () {

    
   
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile/{id}', [AuthController::class, 'updatePost'])->name('profile');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile/orders', [OrderController::class, 'index']);
    Route::get('/profile/services{id}', [OrderController::class, 'showServices']);
    Route::get('/profile/myservices', [OrderController::class, 'showMyServices']);
    Route::get('/services/{id}', [OrderController::class, 'myServices']);

    Route::get('/home', [ServiceController::class, 'index'])->name('services');
});