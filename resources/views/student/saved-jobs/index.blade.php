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
            @forelse ($job_posts_from_saved_jobs as $job_post_from_saved_job)
                <div class="card w-100 mb-2">
                    <div class="card-body row">
                        <div class="col">
                            <h5 class="card-title">{{ $job_post_from_saved_job->position }}</h5>
                            <p class="card-text">{{ $job_post_from_saved_job->company }}</p>
                        </div>
                        <div class="col d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary" style="margin-right: 5px;">View more details</button>
                            <form action="/student/saved-jobs/{{ $job_post_from_saved_job->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type='submit' class="btn btn-danger">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <h2 class="text-center fs-4 text-muted fst-italic align-self-center">No saved jobs</h2>
            @endforelse
        </div>
        <div class="job-details-panel order-xxl-last order-first">
            
        </div>
    </div>
@endsection
