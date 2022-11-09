<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\SavedJobController;
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

Route::controller(JobPostController::class)->group(function(){
    Route::get('/job-posts', 'index');
});

Auth::routes();

Route::middleware(['auth'])->group(function()
{
    Route::middleware(['student.only'])->group(function(){
        Route::controller(StudentController::class)->group(function(){
            Route::get('/student/setup', 'setup');
            Route::patch('/student/profile', 'update');

            Route::middleware(['details.set'])->group(function(){
                Route::get('/student/dashboard', 'dashboard');
                Route::get('/student/profile', 'index');
                Route::get('/student/profile/edit', 'edit');
            });
        });

        Route::controller(SavedJobController::class)->group(function(){
            Route::middleware(['details.set'])->group(function(){
                Route::get('/student/saved-jobs', 'index');
                Route::post('/student/saved-jobs', 'store');
                Route::delete('/student/saved-jobs/{job_post_id}', 'destroy');
            });
        });

        Route::controller(JobApplicationController::class)->group(function(){
            Route::middleware(['details.set'])->group(function(){
                Route::get('/student/job-applications', 'index');
                Route::get('/student/job-applications/create/{job_post_id}', 'create');
                Route::post('/student/job-applications/{job_post_id}', 'store');
                Route::delete('/student/job-applications/{job_application_id}', 'destroy');
            });
        });
    });

    Route::middleware(['company.only'])->group(function(){
        Route::controller(CompanyController::class)->group(function(){
            Route::get('/company/setup', 'setup');
            Route::patch('/company/profile', 'update');

            Route::middleware(['details.set'])->group(function(){
                Route::get('/company/dashboard', 'dashboard');
                Route::get('/company/profile/', 'index');
                Route::get('/company/profile/edit', 'edit');
            });
        });

        Route::middleware(['details.set'])->group(function(){
            Route::controller(JobPostController::class)->group(function(){
                Route::get('/company/job-posts', 'indexOwned');
                Route::get('/company/job-posts/create', 'create');
                Route::post('/company/job-posts', 'store');
                Route::delete('/company/job-posts/{id}', 'destroy');
            });
        });

        Route::controller(JobApplicationController::class)->group(function(){
            Route::middleware(['details.set'])->group(function(){
                Route::patch('/company/job-applications/{job_application_id}', 'update');
            });
        });
    });
    
});