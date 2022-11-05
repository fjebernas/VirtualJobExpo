<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    public function index() {
        return view('company.job-post.index');
    }

    public function create() {
        return view('company.job-post.create');
    }

    public function store() {

    }
}
