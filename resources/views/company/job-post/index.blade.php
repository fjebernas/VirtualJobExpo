@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/company/job-post/index.css">
@endsection
    
@section('customjs')
    <script src="/js/company/job-post/index.js" type="module"></script>
@endsection

@section('content')
    <h1 class="text-center">ALL YOUR JOB POSTS</h1>

    <div class="table-responsive">
        <table class="table text-center table-bordered">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Position</th>
                    <th scope="col">Location</th>
                    <th scope="col">Level</th>
                    <th scope="col">Employment</th>
                    <th scope="col">Salary range</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($job_posts as $job_post)
                    <tr>
                        <td>{{ $job_post->id }}</td>
                        <td>{{ $job_post->position }}</td>
                        <td>{{ $job_post->location }}</td>
                        <td>{{ $job_post->level }}</td>
                        <td>{{ $job_post->employment }}</td>
                        <td>
                            ₱ {{ $job_post->salary_range['low'] }} - {{ $job_post->salary_range['high'] }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <i class="text-muted">No job posts</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
