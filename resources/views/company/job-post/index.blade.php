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
        <table class="table text-center table-bordered bg-white mt-4">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Position</th>
                    <th scope="col">Location</th>
                    <th scope="col">Level</th>
                    <th scope="col">Employment</th>
                    <th scope="col">Salary range</th>
                    <th scope="col">Action</th>
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
                        <td>
                            <form action="/company/job-posts/{{ $job_post->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <i class="text-muted">No job posts</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
