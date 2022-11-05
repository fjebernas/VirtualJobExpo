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

    Route::middleware(['student.only'])->group(function(){
        Route::controller(StudentController::class)->group(function(){
            Route::get('/student/setup', 'setup');
            Route::post('/student/profile', 'update');

            Route::middleware(['details.set'])->group(function(){
                Route::get('/student/dashboard', 'dashboard');
                Route::get('/student/profile', 'index');
                Route::get('/student/profile/edit', 'edit');
            });
        });
    });

    Route::middleware(['company.only'])->group(function(){
        Route::controller(CompanyController::class)->group(function(){
            Route::get('/company/setup', 'setup');
            Route::post('/company/profile', 'update');

            Route::middleware(['details.set'])->group(function(){
                Route::get('/company/dashboard', 'dashboard');
                Route::get('/company/profile/', 'index');
                Route::get('/company/profile/edit', 'edit');
                
                Route::controller(JobPostController::class)->group(function(){
                    Route::get('/company/job-post', 'index');
                    Route::get('/company/job-post/create', 'create');
                    Route::post('/company/job-post', 'store');
                    Route::delete('/company/job-post/{id}', 'destroy');
                });
            });
        });
    });
    
});

Auth::routes();