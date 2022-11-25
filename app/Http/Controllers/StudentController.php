<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentProfileUpdateRequest;
use App\Models\JobPost;
use App\Models\Student;
use App\Services\ProfilePictureService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Show the initial setup form
     *
     * @return \Illuminate\Http\Response
     */
    public function setup() 
    {
        return view('student.setup');
    }

    /**
     * Show the student's dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard() 
    {
        return view('student.dashboard')
                ->with('student', Auth::user()->student)
                ->with('jobs_count', JobPost::all()->count());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student) 
    {
        return view('student.profile.show')
            ->with('student', $student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student) 
    {
        return view('student.profile.edit')
                ->with('student', $student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentProfileUpdateRequest $request, ProfilePictureService $profilePictureService, Student $student) 
    {
        $profilePictureService->handleProfilePicture($request->profile_picture);
        $new_profile_picture_path = $profilePictureService->getFormattedProfilePictureName($request->profile_picture);

        $student->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'university' => $request->university,
            'contact_number' => $request->contact_number,
            'profile_picture_path' => $new_profile_picture_path,
            'about' => $request->about,
        ]);

        return redirect()->route('student.dashboard')
            ->with('notification', [
                'message' => 'Profile successfully updated',
                'type' => 'success'
            ]);
    }
}
