<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{
    public function index() {
        return view('company.job-post.index');
    }

    public function create() {
        return view('company.job-post.create');
    }

    public function store(Request $request) {
        JobPost::create([
            'position' => $request->position,
            'company' => Auth::user()->name,
            'location' => $request->location,
            'level' => $request->level,
            'employment' => $request->employment,
            'salary_range' => [
                                'low' => $request->salary_range[0],
                                'high' => $request->salary_range[1],
                            ],
            'company_id' => Auth::user()->id,
        ]);

        return redirect('/company/job-post/create')
            ->with('notification', [
                'message' => 'Job post created',
                'type' => 'success'
            ]
        );
    }
}
