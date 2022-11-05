<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{
    public function index() {
        $company_id = Company::where('email', Auth::user()->email)->value('id');
        $job_posts = JobPost::where('company_id', $company_id)->get();

        return view('company.job-post.index')
            ->with('job_posts', $job_posts);
    }

    public function create() {
        return view('company.job-post.create');
    }

    public function store(Request $request) {
        JobPost::create([
            'position' => $request->position,
            'company' => Company::where('email', Auth::user()->email)->value('name'),
            'location' => $request->location,
            'level' => $request->level,
            'employment' => $request->employment,
            'salary_range' => [
                                'low' => $request->salary_range[0],
                                'high' => $request->salary_range[1],
                            ],
            'company_id' => Auth::user()->id,
        ]);

        return redirect('/company/dashboard')
            ->with('notification', [
                'message' => 'Job post created',
                'type' => 'success'
            ]
        );
    }

    public function destroy($id) {
        JobPost::where('id', $id)->delete();

        return redirect('/company/job-post')
            ->with('notification', [
                'message' => 'Job post deleted',
                'type' => 'success'
            ]
        );
    }
}
