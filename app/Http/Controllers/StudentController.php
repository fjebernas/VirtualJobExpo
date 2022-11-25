<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentProfileRequest;
use App\Http\Requests\StudentProfileStoreRequest;
use App\Http\Requests\StudentProfileUpdateRequest;
use App\Models\JobPost;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
    public function update(StudentProfileUpdateRequest $request, Student $student) 
    {
        $new_profile_picture_path = $this->getProfilePicturePath($request->profile_picture);

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

        return redirect('/student/dashboard')
            ->with('notification', [
                'message' => 'Profile successfully updated',
                'type' => 'success'
            ]);
    }

    public function getProfilePicturePath($profile_picture)
    {
        if (isset($profile_picture))
        {
            // custom image name
            $new_profile_picture_name = $this->getFormattedProfilePictureName($profile_picture);

            // if there is already a profile picture in public, delete it
            $this->deleteProfilePictureIfExists($new_profile_picture_name);

            // move the image file to public/img/profile-pictures
            $this->storeProfilePictureToDisk($new_profile_picture_name, $profile_picture);

            return $new_profile_picture_name;
        } 
        else 
        {
            return 'placeholder.png';
        }
    }

    public function getFormattedProfilePictureName($profile_picture)
    {
        return 'student' .
                '-' .  
                Auth::user()->student->id . 
                '.' .
                $profile_picture->extension();
    }

    public function deleteProfilePictureIfExists($new_profile_picture_name)
    {
        $new_profile_picture_name_without_extension = Str::of($new_profile_picture_name)->before('.');
        if (str_contains(Auth::user()->student->profile_picture_path, $new_profile_picture_name_without_extension)) 
        {
            Storage::disk('local')->delete('public/students/images/' . Auth::user()->student->profile_picture_path);
        }
    }

    public function storeProfilePictureToDisk($new_profile_picture_name, $profile_picture)
    {
        return Storage::disk('local')->put('public/students/images/' . $new_profile_picture_name, 
                                            File::get($profile_picture)) ? true : false;
    }
}
