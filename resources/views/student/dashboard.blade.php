@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/student/dashboard.css">
@endsection
    
@section('customjs')
    <script src="/js/student/dashboard.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="greeting w-100 rounded d-flex flex-wrap align-items-center justify-content-between px-4 py-4">
            <div>
                <h1 class="text-warning">Welcome, {{ Auth::user()->student->first_name }}.</h1>
                <h2 class="fs-5 text-white">Lorem ipsum dolor sit amet consectetur.</h2>
            </div>
            <div class="table-responsive">
                <table>
                    <thead class="text-warning fs-5">
                        <tr>
                            <td class="text-center text-nowrap border-secondary border-end">Jobs</td>
                            <td class="text-center">Jobs Applied</td>
                        </tr>
                    </thead>
                    <tbody class="text-white text-center">
                        <tr>
                            <td class="table-responsive border-secondary border-end">
                                <table>
                                    <thead class="fs-6 text-muted">
                                        <tr>
                                            <td class="px-2">Available</td>
                                            <td class="px-2 text-nowrap">Saved</td>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-4">
                                        <tr>
                                            <td>{{ $jobs_count }}</td>
                                            <td>{{ $student->savedJobs->count() }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="table-responsive">
                                <table>
                                    <thead class="fs-6 text-muted">
                                        <tr>
                                            <td class="px-2">Received</td>
                                            <td class="px-2">Shortlisted</td>
                                            <td class="px-2 text-nowrap border-secondary border-end">Not qualified</td>
                                            <td class="px-2">Total</td>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-4">
                                        <tr>
                                            <td>{{ $student->jobApplications->where('status', 'Received')->count() }}</td>
                                            <td>{{ $student->jobApplications->where('status', 'Shortlisted')->count() }}</td>
                                            <td class="border-secondary border-end">{{ $student->jobApplications->where('status', 'Not qualified')->count() }}</td>
                                            <td>{{ $student->jobApplications->count() }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="cards-container d-flex justify-content-center flex-wrap mt-5">
            <a href={{ route('student.students.show', Auth::user()->student) }} class="text-decoration-none">
                <div class="card view-profile d-flex justify-content-center align-items-center border-0">
                    <box-icon name='news' size='90px' color='white'></box-icon>
                    <h3 class="fs-5">View Profile</h3>
                </div>
            </a>

            <a href={{ route('student.students.edit', Auth::user()->student) }} class="text-decoration-none">
                <div class="card edit-profile d-flex justify-content-center align-items-center border-0">
                    <box-icon name='edit-alt' size='90px' color='white'></box-icon>
                    <h3 class="fs-5">Edit Profile</h3>
                </div>
            </a>

            <a href='#' class="text-decoration-none">
                <div class="card my-resume d-flex justify-content-center align-items-center border-0">
                    <box-icon type='solid' name='file-pdf' size='90px' color='white'></box-icon>
                    <h3 class="fs-5">My Resume</h3>
                </div>
            </a>

            <a href={{ route('student.saved_jobs.index') }} class="text-decoration-none">
                <div class="card saved-jobs d-flex justify-content-center align-items-center border-0">
                    <box-icon name='spreadsheet' size='90px' color='white'></box-icon>
                    <h3 class="fs-5">Saved Jobs</h3>
                </div>
            </a>

            <a href={{ route('student.job_applications.index') }} class="text-decoration-none">
                <div class="card jobs-applied d-flex justify-content-center align-items-center border-0">
                    <box-icon name='briefcase' size='90px' color='white'></box-icon>
                    <h3 class="fs-5">Jobs Applied</h3>
                </div>
            </a>
        </div>
    </div>
@endsection
