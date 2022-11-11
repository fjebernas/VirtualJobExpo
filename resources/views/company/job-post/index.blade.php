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
                            <p><span class="fw-bold">Salary range: </span> ₱{{ $job_post->salary_range['low'] }} to ₱{{ $job_post->salary_range['high'] }}</p>
                        </div>
                        <div class="col-3">
                            <form class="d-flex justify-content-end" action={{ route('company.job_posts.destroy', $job_post->id) }} method="POST">
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
                                        <th scope="col" style="width: 15%">Name</th>
                                        <th scope="col" style="width: 15%">Email</th>
                                        <th scope="col">Pitch</th>
                                        <th scope="col" style="width: 25%">Action</th>
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
                                                    <form action={{ route('company.job_applications.update', $job_application_received->id) }} method="POST" class="d-flex" style="column-gap: 10px; row-gap: 5px">
                                                        @csrf
                                                        @method('patch')
                                                        <select name="status" class="form-select" aria-label="Default select example" style="width: fit-content">
                                                            @foreach ($statuses as $status)
                                                                <option value="{{ $status }}" 
                                                                    @if ($status == $job_application_received->status)
                                                                        selected 
                                                                    @endif
                                                                >{{ $status }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit" class="btn btn-warning">Update status</button>
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
        <p class="text-muted fst-italic text-center mt-5 fs-4">
            No job posts made. <a href="/company/job-posts/create" class="link-info">Create one now</a> 
        </p>
    @endforelse
@endsection
