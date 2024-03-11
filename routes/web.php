<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MultiAuthController;

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

Route::get('/login',[MultiAuthController::class,'index']);
Route::post('/login-post',[MultiAuthController::class,'postLogin'])->name('user.post.login');

Route::get('/logout',[MultiAuthController::class,'logout'])->name('logout');



Route::middleware(['admin'])->group(function(){
//admin dashboard
Route::get('/admin/dashboard',[MultiAuthController::class,'adminDashboard'])->name('admin.dashboard');
});


Route::middleware(['user'])->group(function(){
   //user dashboard
   Route::get('/user/dashboard',[MultiAuthController::class,'userDashboard'])->name('user.dashboard');
    });
