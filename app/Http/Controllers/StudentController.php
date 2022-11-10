<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function setup() {
        return view('student.setup');
    }

    public function dashboard() {
        return view('student.dashboard');
    }

    public function show($student_id) {
        return view('student.profile.index')
                ->with('student', Student::where('id', $student_id)->firstOrFail());
    }

    public function edit($student_id) {
        return view('student.profile.edit')
                ->with('student', Student::where('id', $student_id)->firstOrFail());
    }

    public function update(Request $request, $student_id) {
        Student::where('id', $student_id)->update([
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
