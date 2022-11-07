@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/student/saved-jobs/index.css">
@endsection
    
@section('customjs')
    <script src="/js/student/saved-jobs/index.js" type="module"></script>
@endsection

@section('content')
    <h1 class="text-center">SAVED JOBS</h1>

    <div class="row gx-4">
        <div class="col">
            @forelse ($saved_jobs as $saved_job)
                <div class="card w-100 mb-2">
                    <div class="card-body">
                        <h5 class="card-title">{{ $saved_job->position }}</h5>
                        <p class="card-text">{{ $saved_job->company }}</p>
                        <div class="d-flex">
                            <button class="btn btn-primary" style="margin-right: 5px;">View more details</button>
                            <form action="/student/job-post/{{ $saved_job->job_post_id }}" method="POST">
                                @csrf
                                @method('delete')

                                <button type='submit' class="btn btn-danger">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <h2 class="text-center fs-3 text-muted fts-italic">No saved jobs</h2>
            @endforelse
        </div>
        <div class="col job-details-panel">
            
        </div>
    </div>
@endsection
