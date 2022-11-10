@extends('layouts.app')

@section('customcss')
    <link rel="stylesheet" href="/css/student/profile/edit.css">
@endsection
    
@section('customjs')
    <script src="/js/student/profile/edit.js" type="module"></script>
@endsection

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center w-100">
        <h1>EDIT PROFILE</h1>

        <div class="card bg-light mt-3 w-100" style="max-width: 42rem">
            <div class="card-header">
                View Profile
            </div>
            <form action={{ route('student.edit_profile') }} method="post">
                @csrf
                @method('patch')

                <div class="card-body d-flex flex-column">
                    <div class="mb-3">
                        <label for="first_name" class="form-label fw-bold fs-5">First name</label>
                        <input name="first_name" value="@isset($student->first_name) {{ $student->first_name }} @endisset" type="text" class="form-control" id="first_name">
                    </div>

                    <div class="mb-3">
                        <label for="middle_name" class="form-label fw-bold fs-5">Middle name</label>
                        <input name="middle_name" value="@isset($student->middle_name) {{ $student->middle_name }} @endisset" type="text" class="form-control" id="middle_name">
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label fw-bold fs-5">Last name</label>
                        <input name="last_name" value="@isset($student->last_name) {{ $student->last_name }} @endisset" type="text" class="form-control" id="last_name">
                    </div>

                    <div class="mb-3">
                        <label for="birthdate" class="form-label fw-bold fs-5">Birthdate</label>
                        <input type="date" value="@isset($student->birthdate){{ $student->birthdate }}@endisset" name="birthdate" class="form-control" id="birthdate">
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label fw-bold fs-5">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="university" class="form-label fw-bold fs-5">University</label>
                        <input name="university" value="@isset($student->university) {{ $student->university }} @endisset" type="text" class="form-control" id="university">
                    </div>

                    <div class="mb-3">
                        <label for="contact_number" class="form-label fw-bold fs-5">Contact number</label>
                        <input name="contact_number" value=@isset($student->contact_number) {{ $student->contact_number }} @else null @endisset type="number" class="form-control" id="contact_number">
                    </div>

                    <button name="" type="submit" class="btn btn-warning align-self-end">Save changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection