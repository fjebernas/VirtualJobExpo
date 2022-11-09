@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/company/setup.css">
@endsection
    
@section('customjs')
    <script src="/js/company/setup.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1>WELCOME! THIS IS THE INITIAL SETUP</h1>

        <div class="card bg-light mt-3" style="min-width: 42rem;">
            <div class="card-header">
                Initial setup
            </div>
            <form action="/company/profile/" method="POST">
                @csrf
                @method('patch')

                <div class="card-body d-flex flex-column">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold fs-5">Company name</label>
                        <input name="name" type="text" class="form-control" id="name">
                    </div>

                    <div class="mb-3">
                        <label for="industry" class="form-label fw-bold fs-5">Industry</label>
                        <input name="industry" type="text" class="form-control" id="industry">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label fw-bold fs-5">Address</label>
                        <input name="address" type="text" class="form-control" id="address">
                    </div>

                    <div class="mb-3">
                        <label for="contact_number" class="form-label fw-bold fs-5">Contact number</label>
                        <input name="contact_number" type="number" class="form-control" id="contact_number">
                    </div>

                    <button name="" type="submit" class="btn btn-warning align-self-end">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
