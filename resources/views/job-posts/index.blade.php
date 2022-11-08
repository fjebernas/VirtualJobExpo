@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/job-posts/index.css">
@endsection
    
@section('customjs')
    <script src="/js/job-posts/index.js" type="module"></script>
@endsection

@section('content')
    <h1 class="text-center">JOB POSTS</h1>

    <div class="d-flex justify-content-center flex-wrap">
        @forelse ($job_posts as $job_post)
            <div class="card mx-3 mt-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $job_post->position }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $job_post->company }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $job_post->location }}</h6>
                    <ul>
                        <li>{{ $job_post->level }}</li>
                        <li>{{ $job_post->employment }}</li>
                        <li>₱{{ $job_post->salary_range['low'] }} - {{ $job_post->salary_range['high'] }}</li>
                    </ul>
                    <div class="d-flex flex-wrap buttons-container">
                        @isset($saved_jobs_id)
                            <a href="/student/job-applications/create/{{ $job_post->id }}" class="btn btn-primary" style="margin-right: 5px;">Apply now</a>
                            @if (in_array($job_post->id, $saved_jobs_id))
                                <form action="/student/saved-jobs/{{ $job_post->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button name="job_post_id" type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            @else
                                <form action="/student/saved-jobs" method="POST">
                                    @csrf
                                    <button name="job_post_id" value="{{ $job_post->id }}" type="submit" class="btn btn-warning">Save</button>
                                </form>
                            @endif
                        @else
                            {{-- No buttons to show if user is not student --}}
                        @endisset
                    </div>
                </div>
            </div>
        @empty
            <h2 class="fs-4 text-center text-muted fst-italic">No available jobs as of now</h2>
        @endforelse
    </div>
@endsection
