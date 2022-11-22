@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/student/saved-jobs/index.css">
@endsection
    
@section('customjs')
    <script src="/js/student/saved-jobs/index.js" type="module"></script>
@endsection

@section('content')
    <h1 class="text-center">SAVED JOBS</h1>

    <div class="gx-4 mt-4 d-flex flex-wrap justify-content-center wrapper">
        <div class="saved-jobs-container order-xxl-first order-last">
            @forelse ($saved_jobs as $saved_job)
                <div class="card w-100 mb-2 saved_job">
                    <div class="card-body row">
                        <div class="col">
                            <a href={{ route('job-posts.show', $saved_job->jobPost) }}
                                target="_blank"
                                class="link text-warning">
                                <h5 class="card-title">{{ $saved_job->jobPost->position }}</h5>
                            </a>
                            <a href={{ route('company.companies.show', $saved_job->jobPost->company) }}
                                target="_blank"
                                class="link text-white">
                                <p class="card-text">{{ $saved_job->jobPost->company->name }}</p>
                            </a>
                        </div>
                        <div class="col d-flex flex-wrap align-items-center justify-content-end"
                            style="column-gap: 5px; row-gap:5px">
                            <button data-job-post='{{ $saved_job->jobPost }}' 
                                    class="btn btn-primary btn-brief-details">
                                View brief details
                            </button>
                            <span data-action-delete={{ route('student.saved_jobs.destroy', $saved_job->jobPost->id) }}>
                                <button class="btn btn-danger btn-delete-saved-job">Remove</button>
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <h2 class="text-center fs-4 text-muted fst-italic align-self-center">No saved jobs</h2>
            @endforelse
        </div>
        <div class="job-details-panel order-xxl-last order-first p-4">
            <div class="d-flex mb-3">
                <h4 class="text-muted">Position:&nbsp;</h4>
                <p class="fs-5 m-0 p-0" id="position"></p>
            </div>
            <div class="d-flex mb-3">
                <h4 class="text-muted">Company:&nbsp;</h4>
                <p class="fs-5 m-0 p-0" id="company"></p>
            </div>
            <div class="d-flex mb-3">
                <h4 class="text-muted">Location:&nbsp;</h4>
                <p class="fs-5 m-0 p-0" id="location"></p>
            </div>
            <div class="d-flex mb-3">
                <h4 class="text-muted">Level:&nbsp;</h4>
                <p class="fs-5 m-0 p-0" id="level"></p>
            </div>
            <div class="d-flex mb-3">
                <h4 class="text-muted">Employment:&nbsp;</h4>
                <p class="fs-5 m-0 p-0" id="employment"></p>
            </div>
            <div class="d-flex mb-3">
                <h4 class="text-muted">Salary range:&nbsp;</h4>
                <p class="fs-5 m-0 p-0" id="salary_range"></p>
            </div>
        </div>
    </div>
@endsection
