@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/admin/saved-jobs/index.css">
@endsection
    
@section('customjs')
    <script src="/js/admin/saved-jobs/index.js" type="module"></script>
@endsection

<style>
    tbody td {
        background-color: #000 !important;
    }
</style>

@section('content')
    <h1 class="text-center">ALL SAVED JOBS</h1>

    <div class="table-responsive">
        <table class="table table-dark text-center table-bordered mt-4 text-nowrap">
            <thead class="bg-dark text-white">
                <tr>
                    <td>ID</td>
                    <td>Position</td>
                    <td>Company</td>
                    <td>Saved by</td>
                    <td>Deleted at</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($saved_jobs as $saved_job)
                    <tr @if ($saved_job->deleted_at) class='text-muted' @endif>
                        <td>{{ $saved_job->id }}</td>
                        <td>{{ $saved_job->jobPost->position }}</td>
                        <td>{{ $saved_job->jobPost->company->name }}</td>
                        <td>{{ $saved_job->student->first_name }} {{ $saved_job->student->last_name }}</td>
                        <td>{{ $saved_job->deleted_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <i class="text-muted">No data available</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 mx-5 d-md-block d-flex justify-content-center">
        {{ $saved_jobs->links() }}
    </div>
@endsection
