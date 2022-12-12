@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/admin/job_applications/index.css">
@endsection
    
@section('customjs')
    <script src="/js/admin/job_applications/index.js" type="module"></script>
@endsection

<style>
    tbody td {
        background-color: #000 !important;
    }
</style>

@section('content')
    <h1 class="text-center">ALL JOB APPLICATIONS</h1>

    <div class="table-responsive">
        <table class="table table-dark text-center table-bordered mt-4 text-nowrap">
            <thead class="bg-dark text-white">
                <tr>
                    <td>ID</td>
                    <td>Student</td>
                    <td>Position</td>
                    <td>Company</td>
                    <td>Pitch</td>
                    <td>Status</td>
                    <td>Deleted at</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($job_applications as $job_application)
                    <tr>
                        <td>{{ $job_application->id }}</td>
                        <td>{{ $job_application->student->first_name }} {{ $job_application->student->last_name }}</td>
                        <td>{{ $job_application->jobPost->position }}</td>
                        <td>{{ $job_application->jobPost->company->name }}</td>
                        <td class="text-center" style="min-width: 300px">
                            <a class="btn btn-link text-warning" 
                                data-bs-toggle="collapse" 
                                href={{ '#pitch_' . $job_application->id }} 
                                role="button" 
                                aria-expanded="false" 
                                aria-controls="collapseExample">
                                Show pitch
                            </a>
                            <p class="collapse text-start text-wrap text-break" 
                                id={{ 'pitch_' . $job_application->id }}>
                                {{ $job_application->pitch }}
                            </p>
                        </td>
                        <td>{{ $job_application->status }}</td>
                        <td>{{ $job_application->deleted_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <i class="text-muted">No data available</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4 mx-5 d-md-block d-flex justify-content-center">
        {{ $job_applications->links() }}
    </div>
@endsection
