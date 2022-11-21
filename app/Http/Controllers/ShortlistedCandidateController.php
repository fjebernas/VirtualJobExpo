<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShortlistedCandidateController extends Controller
{
    public function index()
    {
        return view('company.shortlisted-candidates.index');
    }
}
