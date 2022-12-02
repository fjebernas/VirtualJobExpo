<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeStoreRequest;
use App\Models\Resume;
use App\Services\ResumeService;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('student.resume.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResumeStoreRequest $request, ResumeService $resumeService)
    {
        $resumeService->handleResume($request->resume);

        return redirect()->back()
            ->with('notification', [
                'message' => 'Resume uploaded successfully',
                'type' => 'success'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('student.resume.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, ResumeService $resumeService)
    {
        $resumeService->deleteOldResumeIfExists();
        $resumeService->deleteRecord();

        return redirect()->back()
            ->with('notification', [
                'message' => 'Resume removed successfully',
                'type' => 'success'
            ]);
    }
}
