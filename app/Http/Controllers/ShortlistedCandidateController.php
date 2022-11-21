<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortlistedCandidateController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.shortlisted-candidates.index')
            ->with('job_applications', Auth::user()->company->jobApplicationsReceived
                                                            ->where('status', 'Shortlisted')
                                                            ->all());
    }
}
