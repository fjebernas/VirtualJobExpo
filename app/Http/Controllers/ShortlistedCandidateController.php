<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortlistedCandidateController extends Controller
{
    public function index()
    {
        return view('company.shortlisted-candidates.index')
            ->with('job_applications', Auth::user()->company->jobApplicationsReceived);
    }
}
