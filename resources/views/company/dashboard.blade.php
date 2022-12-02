@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/company/dashboard.css">
@endsection
    
@section('customjs')
    <script src="/js/company/dashboard.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <div class="greeting w-100 rounded d-flex flex-wrap align-items-center justify-content-between px-5 py-4">
            <div>
                <h1 class="text-warning">Welcome, {{ Auth::user()->company->name }}.</h1>
                <h2 class="fs-5 text-white">Lorem ipsum dolor sit amet consectetur.</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless text-center mb-0">
                    <thead class="text-warning fs-5">
                        <tr>
                            <td class="border-secondary border-end p-0 px-2">Job Posts</td>
                            <td class="p-0 px-2">Job Applicants</td>
                        </tr>
                    </thead>
                    <tbody class="text-white fs-3">
                        <tr>
                            <td class="border-secondary border-end p-0">{{ $company->jobPosts->count() }}</td>
                            <td class="p-0">{{ $company->jobApplicationsReceived->count() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="cards-container d-flex justify-content-center flex-wrap mt-5">
            <a href={{ route('company.companies.show', Auth::user()->company) }} class="text-decoration-none">
                <div class="card view-profile d-flex justify-content-center align-items-center">
                    <box-icon name='news' size='90px' color='white'></box-icon>
                    <h3 class="fs-5">View Profile</h3>
                </div>
            </a>

            <a href={{ route('company.companies.edit', Auth::user()->company) }} class="text-decoration-none">
                <div class="card edit-profile d-flex justify-content-center align-items-center">
                    <box-icon name='edit-alt' size='90px' color='white'></box-icon>
                    <h3 class="fs-5">Edit Profile</h3>
                </div>
            </a>

            <a href={{ route('company.job_posts.company_owned_index') }} class="text-decoration-none">
                <div class="card saved-jobs d-flex justify-content-center align-items-center">
                    <box-icon name='table' size='90px' color='white'></box-icon>
                    <h3 class="fs-5">My Job Posts</h3>
                </div>
            </a>

            <a href={{ route('company.shortlisted-candidates.index') }} class="text-decoration-none">
                <div class="card shortlisted-candidates d-flex justify-content-center align-items-center">
                    <box-icon name='user-check' size='90px' color='white'></box-icon>
                    <h3 class="fs-5 text-center">Shortlisted Candidates</h3>
                </div>
            </a>

            <a href={{ route('company.job_posts.create') }} class="text-decoration-none">
                <div class="card jobs-applied d-flex justify-content-center align-items-center">
                    <box-icon name='plus' size='90px' color='white'></box-icon>
                    <h3 class="fs-5">Create Job Post</h3>
                </div>
            </a>
        </div>
    </div>
@endsection
