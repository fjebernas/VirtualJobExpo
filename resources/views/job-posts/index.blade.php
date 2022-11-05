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
        <div class="card mx-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $job_post->position }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $job_post->company }}</h6>
                <ul>
                    <li>{{ $job_post->level }}</li>
                    <li>{{ $job_post->employment }}</li>
                    <li>₱ {{ $job_post->salary_range['low'] }} - {{ $job_post->salary_range['high'] }}</li>
                </ul>
                <a href="#" class="card-link">Apply now</a>
                <a href="#" class="card-link">Save</a>
            </div>
        </div>
        @empty
            
        @endforelse
    </div>
@endsection
