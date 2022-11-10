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
                Route::controller(StudentController::class)->group(function(){
                    /**
                     * Student routes that exclude EnsureUserDetailsAreSet middleware
                     *
                     * 
                     */
                    Route::withoutMiddleware(['details.set'])->group(function(){
                        Route::get('/setup', 'setup')->name('setup');
                        Route::patch('/profile', 'update')->name('update_profile');
                    });
                    
        
                    Route::get('/dashboard', 'dashboard')->name('dashboard');
                    Route::get('/profile', 'index')->name('profile');
                    Route::get('/profile/edit', 'edit')->name('edit_profile');
                });
        
                /**
                 * Student routes managed by SavedJobController
                 *
                 * 
                 */
                // Route::controller(SavedJobController::class)->group(function(){
                //     Route::get('/saved-jobs', 'index')->name('saved_jobs');
                //     Route::post('/saved-jobs', 'store')->name('store_saved_job');
                //     Route::delete('/saved-jobs/{job_post_id}', 'destroy')->name('destroy_saved_job');
                // });
                Route::resource('saved_jobs', SavedJobController::class)->only([
                    'index', 'store', 'destroy',
                ]);
        
                /**
                 * Student routes managed by JobApplicationController
                 *
                 * 
                 */
                Route::controller(JobApplicationController::class)->group(function(){
                    Route::get('/job-applications', 'index')->name('job_applications');
                    Route::get('/job-applications/create/{job_post_id}', 'create')->name('create_job_application');
                    Route::post('/job-applications/{job_post_id}', 'store')->name('store_job_application');
                    Route::delete('/job-applications/{job_application_id}', 'destroy')->name('destroy_job_application');
                });
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
                 * Routes managed by CompanyController
                 *
                 * 
                 */
                Route::controller(CompanyController::class)->group(function(){
                    /**
                     * Company routes that exclude EnsureUserDetailsAreSet middleware
                     *
                     * 
                     */
                    Route::withoutMiddleware(['details.set'])->group(function(){
                        Route::get('/setup', 'setup')->name('setup');
                        Route::patch('/profile', 'update')->name('update_profile');
                    });
        
                    Route::get('/dashboard', 'dashboard')->name('dashboard');
                    Route::get('/profile', 'index')->name('profile');
                    Route::get('/profile/edit', 'edit')->name('edit_profile');
                });
        
                /**
                 * Company routes managed by JobPostController
                 *
                 * 
                 */
                Route::controller(JobPostController::class)->group(function(){
                    Route::get('/job-posts', 'indexOwned')->name('job_posts');
                    Route::get('/job-posts/create', 'create')->name('create_job_post');
                    Route::post('/job-posts', 'store')->name('store_job_post');
                    Route::delete('/job-posts/{job_post_id}', 'destroy')->name('destroy_job_post');
                });
        
                /**
                 * Company routes managed by JobApplicationController
                 *
                 * 
                 */
                Route::controller(JobApplicationController::class)->group(function(){
                    Route::patch('/job-applications/{job_application_id}', 'update')->name('update_job_application');
                });
            });
        });
        
    });
});