@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/company/profile/edit.css">
@endsection
    
@section('customjs')
    <script src="/js/company/profile/edit.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center w-100">
        <h1>EDIT PROFILE</h1>

        <div class="card mt-3 w-100">
            <form action={{ route('company.companies.update', $company->id) }} method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="card-body d-flex flex-column">
                    <div class="mb-3">
                        <label for="name" class="text-muted form-label fw-bold fs-5">Company name</label>
                        <input name="name" value="@isset($company->name) {{ $company->name }} @endisset" type="text" class="form-control" id="name">
                    </div>

                    <div class="mb-3">
                        <label for="industry" class="text-muted form-label fw-bold fs-5">Industry</label>
                        <input name="industry" value="@isset($company->industry) {{ $company->industry }} @endisset" type="text" class="form-control" id="industry">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="text-muted form-label fw-bold fs-5">Address</label>
                        <input name="address" value="@isset($company->address) {{ $company->address }} @endisset" type="text" class="form-control" id="address">
                    </div>

                    <div class="mb-3">
                        <label for="contact_number" class="text-muted form-label fw-bold fs-5">Contact number</label>
                        <input name="contact_number" value=@isset($company->contact_number) {{ $company->contact_number }} @else null @endisset type="number" class="form-control" id="contact_number">
                    </div>

                    <div class="mb-3">
                        <label class="text-muted form-label fw-bold fs-5" for="profile_picture">Profile picture</label>
                        <input name="profile_picture" type="file" class="form-control" id="profile_picture" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="about" class="text-muted form-label fw-bold fs-5">About</label>
                        <textarea name="about" class="form-control" id="about" rows="3">@isset($company->about) {{ $company->about }}@endisset</textarea>
                    </div>

                    <button name="" type="submit" class="btn btn-warning align-self-end">Save changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection