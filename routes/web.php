<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\StudentController;
use App\Models\JobApplication;
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

/**
 * Anyone can view job posts, including guests
 *
 * 
 */
Route::controller(JobPostController::class)->group(function(){
    Route::get('/job-posts', 'index');
});

Auth::routes();

Route::middleware(['auth', 'details.set'])->group(function(){
    /**
     * Student routes
     *
     * 
     */
    Route::middleware(['student.only'])->group(function(){
        Route::prefix('student')->group(function(){
            Route::name('student.')->group(function(){
                /**
                 * Student routes managed by StudentController
                 *
                 * 
                 */
                Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
                // This group below needs to be excluded from EnsureUserDetailsAreSet middleware
                
                Route::withoutMiddleware(['details.set'])->group(function(){
                    Route::get('/setup', [StudentController::class, 'setup'])->name('setup');
                    Route::resource('students', StudentController::class)->only([
                        'show', 'edit', 'update',
                    ]);
                });
        
                /**
                 * Student routes managed by SavedJobController
                 *
                 * 
                 */
                Route::resource('saved_jobs', SavedJobController::class)->only([
                    'index', 'store', 'destroy',
                ]);
        
                /**
                 * Student routes managed by JobApplicationController
                 *
                 * 
                 */
                Route::resource('job_applications', JobApplicationController::class)->only([
                    'index', 'store', 'destroy',
                ]);

                // Create-job-application route is separated because it needs the job post id
                Route::get('/job-applications/create/{job_post_id}', [JobApplicationController::class, 'create'])
                    ->name('job_applications.create');
            });
        });
    });

    /**
     * Company routes
     *
     * 
     */
    Route::middleware(['company.only'])->group(function(){
        Route::name('company.')->group(function(){
            Route::prefix('company')->group(function(){
                /**
                 * Company routes managed by CompanyController
                 *
                 * 
                 */
                Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');

                // This group below needs to be excluded from EnsureUserDetailsAreSet middleware
                Route::withoutMiddleware(['details.set'])->group(function(){
                    Route::get('/setup', [CompanyController::class, 'setup'])->name('setup');
                    Route::resource('companies', CompanyController::class)->only([
                        'show', 'edit', 'update',
                    ]);
                });
        
                /**
                 * Company routes managed by JobPostController
                 *
                 * 
                 */
                Route::resource('job_posts', JobPostController::class)->only([
                    'index', 'create', 'store', 'destroy',
                ]);
        
                /**
                 * Company routes managed by JobApplicationController
                 *
                 * 
                 */
                Route::resource('job_applications', JobApplicationController::class)->only([
                    'update',
                ]);
            });
        });
        
    });
});