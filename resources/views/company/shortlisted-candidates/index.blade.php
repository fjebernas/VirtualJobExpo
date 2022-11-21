@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/company/shortlisted-candidates/index.css">
@endsection
    
@section('customjs')
    <script src="/js/company/shortlisted-candidates/index.js" type="module"></script>
@endsection

@section('content')
    <h1 class="text-center">SHORTLISTED CANDIDATES</h1>

    <div class="table-responsive">
        <table class="table table-dark text-center table-bordered mt-4">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Job Post</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($job_applications as $job_application)
                    <tr>
                        <td>{{ $job_application->student->last_name }}</td>
                        <td>{{ $job_application->student->user->email }}</td>
                        <td>{{ $job_application->jobPost->position }}</td>
                        <td>
                            <button type='button' class="btn btn-warning">Send invitation</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <i class="text-muted">No shortlisted candidates</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
