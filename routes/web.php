<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FilteredJobPostController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\ShortlistedCandidateController;
use App\Http\Controllers\StudentController;
use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Support\Benchmark;
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

/**
 * For testing
 *
 * 
 */
// Route::get('/exp', function(){
//     dd(asset('storage/students/images/' . 'placeholder.png'));
// });

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
    Route::get('/job-posts/{job_post}', 'show')->name('job-posts.show');
});
/**
 * Route for searching job with filters
 */
Route::post('/job-posts/search', FilteredJobPostController::class)->name('job-posts.search');

Auth::routes();

Route::middleware(['auth', 'details.set'])->group(function(){
    /**
     * Student routes
     *
     * 
     */
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

            /**
             * Student routes managed by ResumeController
             *
             * 
             */
            Route::resource('resumes', ResumeController::class)->only([
                'create', 'store', 'destroy',
            ]);
        });
    });

    /**
     * Company routes
     *
     * 
     */
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
                'create', 'store', 'destroy',
            ]);
            // Route for job posts owned by company
            Route::get('/job-posts', [JobPostController::class, 'companyOwnedIndex'])
                ->name('job_posts.company_owned_index');
    
            /**
             * Company routes managed by JobApplicationController
             *
             * 
             */
            Route::resource('job_applications', JobApplicationController::class)->only([
                'update',
            ]);

            /**
             * Company routes managed by ShortlistedCandidateController
             *
             * 
             */
            Route::controller(ShortlistedCandidateController::class)->group(function(){
                Route::get('/shortlisted-candidates', 'index')
                    ->name('shortlisted-candidates.index');
                Route::post('/shortlisted-candidates', 'sendInvitation')
                    ->name('shortlisted-candidates.send-invitation');
            });
        });
    });
});