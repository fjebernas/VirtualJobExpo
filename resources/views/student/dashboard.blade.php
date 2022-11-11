@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/student/dashboard.css">
@endsection
    
@section('customjs')
    <script src="/js/student/dashboard.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="greeting row w-100 d-flex align-items-center px-3">
            <div>
                <h1>Welcome, {{ Auth::user()->email }}.</h1>
                <h2 class="fs-5">Lorem ipsum dolor sit amet consectetur.</h2>
            </div>
        </div>

        <div class="cards-container d-flex justify-content-center flex-wrap mt-5">
            <a href={{ route('student.students.show', Auth::user()->student->id) }} class="text-decoration-none">
                <div class="card view-profile d-flex justify-content-center align-items-center">
                    <box-icon name='news' size='90px' color='green'></box-icon>
                    <h3 class="fs-5">View Profile</h3>
                </div>
            </a>

            <a href={{ route('student.students.edit', Auth::user()->student->id) }} class="text-decoration-none">
                <div class="card edit-profile d-flex justify-content-center align-items-center">
                    <box-icon name='edit-alt' size='90px' color='orange'></box-icon>
                    <h3 class="fs-5">Edit Profile</h3>
                </div>
            </a>

            <a href={{ route('student.saved_jobs.index') }} class="text-decoration-none">
                <div class="card saved-jobs d-flex justify-content-center align-items-center">
                    <box-icon name='spreadsheet' size='90px' color='violet'></box-icon>
                    <h3 class="fs-5">Saved Jobs</h3>
                </div>
            </a>

            <a href={{ route('student.job_applications.index') }} class="text-decoration-none">
                <div class="card jobs-applied d-flex justify-content-center align-items-center">
                    <box-icon name='briefcase' size='90px' color='darkblue'></box-icon>
                    <h3 class="fs-5">Jobs Applied</h3>
                </div>
            </a>
        </div>
    </div>
@endsection
