@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/company/view.css">
@endsection
    
@section('customjs')
    <script src="/js/company/view.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>VIEW PROFILE</h1>

        <div class="card bg-light mt-3" style="min-width: 42rem;">
            <div class="card-header">
                View Profile
            </div>
            <div class="card-body">
                <h5 class="card-title fw-bold">Company name</h5>
                <p class="card-text">
                    @isset($company->name)
                        {{ $company->name }}
                    @endisset
                </p>
            
                <h5 class="card-title fw-bold">Industry</h5>
                <p class="card-text">
                    @isset($company->industry)
                        {{ $company->industry }}
                    @endisset
                </p>

                <h5 class="card-title fw-bold">Address</h5>
                <p class="card-text">
                    @isset($company->address)
                        {{ $company->address }}
                    @endisset
                </p>

                <h5 class="card-title fw-bold">Email</h5>
                <p class="card-text">
                    @isset($company->email)
                        {{ $company->email }}
                    @endisset
                </p>

                <h5 class="card-title fw-bold">Contact number</h5>
                <p class="card-text">
                    @isset($company->contact_number)
                        {{ $company->contact_number }}
                    @endisset
                </p>
            </div>
        </div>
    </div>
@endsection