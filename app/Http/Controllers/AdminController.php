<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\SavedJob;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function userIndex()
    {
        return view('admin.users.index')
            ->with('users', User::orderBy('id', 'asc')
                                ->paginate(10));
    }

    public function studentIndex()
    {
        return view('admin.students.index')
            ->with('students', Student::orderBy('id', 'asc')
                                    ->paginate(10));
    }

    public function companyIndex()
    {
        return view('admin.companies.index')
            ->with('companies', Company::orderBy('id', 'asc')
                                    ->paginate(10));
    }

    public function jobPostIndex()
    {
        return view('admin.job-posts.index')
            ->with('job_posts', JobPost::withTrashed()
                                    ->orderBy('id', 'asc')
                                    ->paginate(10));
    }

    public function savedJobIndex()
    {
        return view('admin.saved-jobs.index')
            ->with('saved_jobs', SavedJob::withTrashed()
                                    ->orderBy('id', 'asc')
                                    ->paginate(10));
    }

    public function jobApplicationIndex()
    {
        return view('admin.job-applications.index')
            ->with('job_applications', JobApplication::withTrashed()
                                                    ->orderBy('id', 'asc')
                                                    ->paginate(10));
    }
}
