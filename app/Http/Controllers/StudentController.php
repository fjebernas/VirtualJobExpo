<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard() {
        return view('student.dashboard');
    }

    public function view() {
        return view('student.view')
                ->with('student', Student::where('email', Auth::user()->email)->firstOrFail());
    }

    public function edit() {
        return view('student.edit')
                ->with('student', Student::where('email', Auth::user()->email)->firstOrFail());;
    }

    public function update() {

    }
}
