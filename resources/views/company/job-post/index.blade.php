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
            <div class="card mt-3 w-100" style="">
                <div class="card-header bg-dark text-muted">
                    Job post ID: {{ $job_post->id }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p class="text-white"><span class="fw-bold text-muted">Position: </span> {{ $job_post->position }}</p>
                            <p class="text-white"><span class="fw-bold text-muted">Level: </span> {{ $job_post->level }}</p>
                        </div>
                        <div class="col">
                            <p class="text-white"><span class="fw-bold text-muted">Location: </span> {{ $job_post->location }}</p>
                            <p class="text-white"><span class="fw-bold text-muted">Employment: </span> {{ $job_post->employment }}</p>
                        </div>
                        <div class="col-4">
                            <p class="text-white"><span class="fw-bold text-muted">Salary range: </span> ₱{{ $job_post->salary_range['low'] }} to ₱{{ $job_post->salary_range['high'] }}</p>
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
                            <table class="table table-dark text-center table-bordered mt-4">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 15%">Name</th>
                                        <th scope="col" style="width: 15%">Email</th>
                                        <th scope="col">Pitch</th>
                                        <th scope="col" style="width: 15%">Date Submitted</th>
                                        <th scope="col" style="width: 10%">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($job_post->jobApplications as $job_application)
                                        <tr>
                                            <td>
                                                <a href={{ route('student.students.show', $job_application->student) }}
                                                    class="link text-warning"
                                                    style="text-decoration: none;">
                                                    {{ $job_application->student->first_name }}
                                                    {{ $job_application->student->last_name }}
                                                </a>
                                            </td>
                                            <td>{{ $job_application->student->user->email }}</td>
                                            <td>{{ $job_application->pitch }}</td>
                                            <td>{{ $job_application->created_at }}</td>
                                            <td class="d-flex justify-content-center flex-wrap" style="row-gap: 5px">
                                                <form action={{ route('company.job_applications.update', $job_application->id) }} class="d-flex" style="column-gap: 10px; row-gap: 5px">
                                                    <select id="select-status" name="status" class="form-select" aria-label="Default select example" style="width: fit-content">
                                                        @foreach ($statuses as $status)
                                                            <option value="{{ $status }}" 
                                                                @if ($status == $job_application->status)
                                                                    selected 
                                                                @endif
                                                            >{{ $status }}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
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
        <p class="text-white fst-italic text-center mt-5 fs-5">
            No job posts made. <a href={{ route('company.job_posts.create') }} class="text-warning">Create one now</a> 
        </p>
    @endforelse
@endsection
