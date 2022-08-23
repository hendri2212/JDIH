<?php

use App\Http\Controllers\admin\AuthenticationController;
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

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthenticationController::class, 'createLogin'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'storeLogin'])->name('login.action');
    Route::get('/register', [AuthenticationController::class, 'createRegister'])->name('register');
    Route::post('/register', [AuthenticationController::class, 'storeRegister']);
});

Route::post('/logout', [AuthenticationController::class, 'logout'])->middleware('auth');
Route::get('/{any}', function () {
    return view('layout.app');
})->where('any', '.*')->middleware('auth');

// Route::middleware('guest')->group(function () {
// });
