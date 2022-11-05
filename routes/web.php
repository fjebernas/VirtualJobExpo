<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobPostController;
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

    Route::middleware(['student'])->group(function(){
        Route::controller(StudentController::class)->group(function(){
            Route::get('/student/dashboard', 'dashboard');
            Route::get('/student/view', 'view');
            Route::get('/student/edit', 'edit');
            Route::post('/student', 'update');
        });
    });

    Route::middleware(['company'])->group(function(){
        Route::controller(CompanyController::class)->group(function(){
            Route::get('/company/dashboard', 'dashboard');
            Route::get('/company/view', 'view');
            Route::get('/company/edit', 'edit');
            Route::post('/company', 'update');

            Route::controller(JobPostController::class)->group(function(){
                Route::get('/company/job-post/', 'index');
                Route::get('/company/job-post/create', 'create');
                Route::post('/company/job-post/', 'store');
            });
        });
    });
    
});

Auth::routes();