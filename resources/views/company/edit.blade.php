@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/company/edit.css">
@endsection
    
@section('customjs')
    <script src="/js/company/edit.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>EDIT PROFILE</h1>

        <div class="card bg-light mt-3" style="min-width: 42rem;">
            <div class="card-header">
                View Profile
            </div>
            <form action="/company" method="POST">
                @csrf

                <div class="card-body d-flex flex-column">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold fs-5">Company name</label>
                        <input name="name" value="@isset($company->name) {{ $company->name }} @endisset" type="text" class="form-control" id="name">
                    </div>

                    <div class="mb-3">
                        <label for="industry" class="form-label fw-bold fs-5">Industry</label>
                        <input name="industry" value="@isset($company->industry) {{ $company->industry }} @endisset" type="text" class="form-control" id="industry">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label fw-bold fs-5">Address</label>
                        <input name="address" value="@isset($company->address) {{ $company->address }} @endisset" type="text" class="form-control" id="address">
                    </div>

                    <div class="mb-3">
                        <label for="contact_number" class="form-label fw-bold fs-5">Contact number</label>
                        <input name="contact_number" value="@isset($company->contact_number) {{ $company->contact_number }} @endisset" type="number" class="form-control" id="contact_number">
                    </div>

                    <button name="" type="submit" class="btn btn-warning align-self-end">Save changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection