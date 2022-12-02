<?php

namespace App\Services;

use App\Models\Resume;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResumeService
{
    /**
     * 
     *
     * @param Illuminate\Http\UploadedFile $resume
     * @return string $new_resume_name
     */
    public function handleResume($resume)
    {
        $this->deleteOldResumeIfExists();

        $new_resume_name = $this->createPathFor($resume);

        $this->storeResumeToDisk($new_resume_name, $resume);

        $this->storeRecord($new_resume_name);
    }

    /**
     * 
     *
     * @param Illuminate\Http\UploadedFile $resume
     * @return string
     */
    public function createPathFor($resume)
    {
        return  Auth::user()->student->id . 
                                        '.' .
                                        $resume->extension();
    }

    /**
     * 
     *
     * @param string $new_resume_name
     * @return void
     */
    public function deleteOldResumeIfExists()
    {
        if (Auth::user()->student->resume && Auth::user()->student->resume->path != null)
        {
            Storage::disk('local')->delete('public/' .                                  // public
                                            Str::plural(Auth::user()->role) . '/' .     // students
                                            'resumes/' .                                // resumes
                                            Auth::user()->student->resume->path);       // (path)

            $this->deleteRecord();
        }
    }

    /**
     * 
     *
     * @param string $new_resume_name
     * @param Illuminate\Http\UploadedFile $resume
     * @return bool
     */
    public function storeResumeToDisk($new_resume_name, $resume)
    {
        return Storage::disk('local')->put('public/' .                                  // public
                                            Str::plural(Auth::user()->role) . '/' .     // students
                                            'resumes/' .                                // resumes
                                            $new_resume_name,                           // (path)
                                            
                                            File::get($resume));
    }

    /**
     * 
     * @param string $new_resume_name
     * @return void
     */
    public function storeRecord($new_resume_name)
    {
        Resume::create([
            'path' => $new_resume_name,
            'student_id' => Auth::user()->student->id,
        ]);
    }

    /**
     * 
     *
     * @return void
     */
    public function deleteRecord()
    {
        Resume::where('student_id', Auth::user()->student->id)->delete();
    }
}