@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/student/dashboard.css">
@endsection
    
@section('customjs')
    <script src="/js/student/dashboard.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="greeting w-100 d-flex flex-wrap align-items-center justify-content-between px-5 py-3">
            <div>
                <h1 class="text-warning">Welcome, {{ Auth::user()->student->first_name }}.</h1>
                <h2 class="fs-5 text-white">Lorem ipsum dolor sit amet consectetur.</h2>
            </div>
            <div>
                <div class="row">
                    <div class="col text-nowrap">
                        <h5 class="text-warning pb-0 mb-0">Saved Jobs</h5>
                    </div>
                    <div class="col text-nowrap">
                        <h5 class="text-warning pb-0 mb-0">Jobs Applied</h5>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col">
                        <p class="fs-2 pb-0 mb-0 text-center text-white">
                            {{ $student->savedJobs->count() }}
                        </p>
                    </div>
                    <div class="col">
                        <p class="fs-2 pb-0 mb-0 text-center text-white">
                            {{ $student->jobApplications->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="cards-container d-flex justify-content-center flex-wrap mt-5">
            <a href={{ route('student.students.show', Auth::user()->student) }} class="text-decoration-none">
                <div class="card view-profile d-flex justify-content-center align-items-center">
                    <box-icon name='news' size='90px' color='white'></box-icon>
                    <h3 class="fs-5">View Profile</h3>
                </div>
            </a>

            <a href={{ route('student.students.edit', Auth::user()->student) }} class="text-decoration-none">
                <div class="card edit-profile d-flex justify-content-center align-items-center">
                    <box-icon name='edit-alt' size='90px' color='white'></box-icon>
                    <h3 class="fs-5">Edit Profile</h3>
                </div>
            </a>

            <a href={{ route('student.saved_jobs.index') }} class="text-decoration-none">
                <div class="card saved-jobs d-flex justify-content-center align-items-center">
                    <box-icon name='spreadsheet' size='90px' color='white'></box-icon>
                    <h3 class="fs-5">Saved Jobs</h3>
                </div>
            </a>

            <a href={{ route('student.job_applications.index') }} class="text-decoration-none">
                <div class="card jobs-applied d-flex justify-content-center align-items-center">
                    <box-icon name='briefcase' size='90px' color='white'></box-icon>
                    <h3 class="fs-5">Jobs Applied</h3>
                </div>
            </a>
        </div>
    </div>
@endsection
