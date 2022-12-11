@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/admin/companys/index.css">
@endsection
    
@section('customjs')
    <script src="/js/admin/companys/index.js" type="module"></script>
@endsection

<style>
    tbody td {
        background-color: #000 !important;
    }
</style>

@section('content')
    <h1 class="text-center">ALL COMPANIES</h1>

    <div class="table-responsive">
        <table class="table table-dark text-center table-bordered mt-4 text-nowrap">
            <thead class="bg-dark text-white">
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Industry</td>
                    <td>Address</td>
                    <td>Contact number</td>
                    <td>About</td>
                </tr>
            </thead>
            <tbody>
                @forelse ($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->industry }}</td>
                        <td>{{ $company->address }}</td>
                        <td>{{ $company->contact_number }}</td>
                        <td class="text-center" style="min-width: 300px">
                            <a class="btn btn-link text-warning" 
                                data-bs-toggle="collapse" 
                                href={{ '#about_' . $company->id }} 
                                role="button" 
                                aria-expanded="false" 
                                aria-controls="collapseExample">
                                Show about
                            </a>
                            <p class="collapse text-start text-wrap text-break" 
                                id={{ 'about_' . $company->id }}>
                                {{ $company->about }}
                            </p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <i class="text-muted">No data available</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4 mx-5 d-md-block d-flex justify-content-center">
        {{ $companies->links() }}
    </div>
@endsection
