<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function setup() 
    {
        return view('student.setup');
    }

    public function dashboard() 
    {
        return view('student.dashboard');
    }

    public function show(Student $student) 
    {
        return view('student.profile.index')
            ->with('student', $student);
    }

    public function edit(Student $student) 
    {
        return view('student.profile.edit')
                ->with('student', $student);
    }

    public function update(Request $request, Student $student) 
    {
        $student->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'university' => $request->university,
            'contact_number' => $request->contact_number,
        ]);

        return redirect('/student/dashboard')
            ->with('notification', [
                'message' => 'Profile successfully updated',
                'type' => 'success'
            ]);
    }
}
