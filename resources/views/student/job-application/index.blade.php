@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/student/job-application/index.css">
@endsection
    
@section('customjs')
    <script src="/js/student/job-application/index.js" type="module"></script>
@endsection

@section('content')
    <h1 class="text-center">JOB APPLICATION STATUS</h1>

    <div class="table-responsive">
        <table class="table text-center table-bordered bg-white mt-4">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Position</th>
                    <th scope="col">Company</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($job_applications as $job_application)
                    <tr>
                        <td>{{ $job_application->id }}</td>
                        <td>{{ $job_posts_applied[$loop->index]->position }}</td>
                        <td>{{ $job_posts_applied[$loop->index]->company }}</td>
                        <td class="fst-italic fw-bold">
                            @switch($job_application->status)
                                @case('Received')
                                    <span class="text-info">
                                    @break
                                @case('Shortlisted')
                                    <span class="text-success">
                                    @break
                                @case('Not qualified')
                                    <span class="text-danger">
                                    @break
                                @default
                                    <span class="text-warning">Unknown status
                            @endswitch
                                        {{ $job_application->status }}
                                    </span>
                        </td>
                        <td>
                            <form action={{ route('student.job_applications.destroy', $job_application->id) }} method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Withdraw</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <i class="text-muted">No jobs applied</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
