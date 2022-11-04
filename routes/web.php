<?php

use App\Http\Controllers\StudentController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function(){

    Route::controller(StudentController::class)->group(function(){
        Route::get('/student/dashboard', 'dashboard');
        Route::get('/student/view', 'view');
        Route::get('/student/edit', 'edit');
    });
    
});

Auth::routes();