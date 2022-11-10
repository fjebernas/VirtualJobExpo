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

Route::middleware(['auth', 'details.set'])->group(function()
{
    /**
     * Student routes
     *
     * 
     */
    Route::middleware(['student.only'])->group(function(){
        Route::name('student.')->group(function(){
            Route::prefix('student')->group(function(){
                
                /**
                 * Student routes managed by student controller
                 *
                 * 
                 */
                Route::controller(StudentController::class)->group(function(){
                    /**
                     * Student routes that excludes details.set middleware
                     *
                     * 
                     */
                    Route::withoutMiddleware(['details.set'])->group(function(){
                        Route::get('/setup', 'setup')->name('setup');
                        Route::patch('/profile', 'update')->name('update_profile');
                    });
                    
        
                    Route::get('/dashboard', 'dashboard')->name('dashboard');
                    Route::prefix('profile')->group(function(){
                        Route::get('/', 'index')->name('profile');
                        Route::get('/edit', 'edit')->name('edit_profile');
                    });
                });
        
                /**
                 * Student routes managed by savedjob controller
                 *
                 * 
                 */
                Route::controller(SavedJobController::class)->group(function(){
                    Route::prefix('saved-jobs')->group(function(){
                        Route::get('/', 'index')->name('saved_jobs');
                        Route::post('/', 'store')->name('store_saved_job');
                        Route::delete('/{job_post_id}', 'destroy')->name('destroy_saved_job');
                    });
                });
        
                /**
                 * Student routes managed by jobapplication controller
                 *
                 * 
                 */
                Route::controller(JobApplicationController::class)->group(function(){
                    Route::prefix('job-applications')->group(function(){
                        Route::get('/', 'index')->name('job_applications');
                        Route::get('/create/{job_post_id}', 'create')->name('create_job_application');
                        Route::post('/{job_post_id}', 'store')->name('store_job_application');
                        Route::delete('/{job_application_id}', 'destroy')->name('destroy_job_application');
                    });
                });
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