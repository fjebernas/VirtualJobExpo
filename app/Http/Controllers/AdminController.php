<?php

namespace App\Http\Controllers;

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
            ->with('users', User::all());
    }

    public function studentIndex()
    {
        return view('admin.students.index')
            ->with('students', Student::all());
    }

    public function companyIndex()
    {

    }

    public function jobPostIndex()
    {

    }

    public function jobApplicationIndex()
    {

    }
}
