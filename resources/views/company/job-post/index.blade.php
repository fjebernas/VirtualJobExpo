@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/company/job-post/index.css">
@endsection
    
@section('customjs')
    <script src="/js/company/job-post/index.js" type="module"></script>
@endsection

@section('content')
    <h1 class="text-center">YOUR JOB POSTS</h1>

    @forelse ($job_posts as $job_post)
        <div class="py-3">
            <div class="card bg-light mt-3 w-100" style="">
                <div class="card-header bg-dark text-white">
                    Job post ID: {{ $job_post->id }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p><span class="fw-bold">Position: </span> {{ $job_post->position }}</p>
                            <p><span class="fw-bold">Level: </span> {{ $job_post->level }}</p>
                        </div>
                        <div class="col">
                            <p><span class="fw-bold">Location: </span> {{ $job_post->location }}</p>
                            <p><span class="fw-bold">Employment: </span> {{ $job_post->employment }}</p>
                        </div>
                        <div class="col-4">
                            <p><span class="fw-bold">Salary range: </span> ₱{{ $job_post->salary_range['low'] }} - {{ $job_post->salary_range['high'] }}</p>
                        </div>
                        <div class="col-3">
                            <form class="d-flex justify-content-end" action="/company/job-posts/{{ $job_post->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete job post</button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table text-center table-bordered bg-white mt-4">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th scope="col" style="width: 20%">Name</th>
                                        <th scope="col" style="width: 20%">Email</th>
                                        <th scope="col">Pitch</th>
                                        <th scope="col" style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($job_applications_received as $job_application_received)
                                        @if ($job_application_received->job_post_id == $job_post->id)
                                            <tr>
                                                <td>{{ $job_application_received->name }}</td>
                                                <td>{{ $job_application_received->email }}</td>
                                                <td>{{ $job_application_received->pitch }}</td>
                                                <td class="d-flex justify-content-center flex-wrap" style="row-gap: 5px">
                                                    <form action="/company/job-applications/{{ $job_application_received->id }}" method="POST" class="col">
                                                        @csrf
                                                        @method('patch')
                                                        <button name="status" value="Shortlisted" type="submit" class="btn btn-warning">Shortlist</button>
                                                    </form>
                                                    <form action="/company/job-applications/{{ $job_application_received->id }}" method="POST" class="col">
                                                        @csrf
                                                        @method('patch')
                                                        <button name="status" value="Not qualified" type="submit" class="btn btn-danger">Not qualified</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="4">
                                                <i class="text-muted">No applications yet</i>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (!$loop->last)
            <hr>
        @endif
    @empty
        empty wtf
    @endforelse

    {{-- <div class="table-responsive">
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
                            ₱{{ $job_post->salary_range['low'] }} - {{ $job_post->salary_range['high'] }}
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
    </div> --}}
@endsection
