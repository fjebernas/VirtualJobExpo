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

        <div class="card w-100 mt-3">
            <form action={{ route('student.students.update', $student) }} method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="card-body d-flex flex-column">
                    <div class="mb-3">
                        <label for="first_name" class="form-label fw-bold fs-5 text-muted">First name</label>
                        <input name="first_name" value="@isset($student->first_name) {{ $student->first_name }} @endisset" type="text" class="form-control" id="first_name">
                    </div>

                    <div class="mb-3">
                        <label for="middle_name" class="form-label fw-bold fs-5 text-muted">Middle name</label>
                        <input name="middle_name" value="@isset($student->middle_name) {{ $student->middle_name }} @endisset" type="text" class="form-control" id="middle_name">
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label fw-bold fs-5 text-muted">Last name</label>
                        <input name="last_name" value="@isset($student->last_name) {{ $student->last_name }} @endisset" type="text" class="form-control" id="last_name">
                    </div>

                    <div class="mb-3">
                        <label for="birthdate" class="form-label fw-bold fs-5 text-muted">Birthdate</label>
                        <input type="date" value="@isset($student->birthdate){{ $student->birthdate }}@endisset" name="birthdate" class="form-control" id="birthdate">
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label fw-bold fs-5 text-muted">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="university" class="form-label fw-bold fs-5 text-muted">University</label>
                        <input name="university" value="@isset($student->university) {{ $student->university }} @endisset" type="text" class="form-control" id="university">
                    </div>

                    <div class="mb-3">
                        <label for="contact_number" class="form-label fw-bold fs-5 text-muted">Contact number</label>
                        <input name="contact_number" value=@isset($student->contact_number) {{ $student->contact_number }} @else null @endisset type="number" class="form-control" id="contact_number">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold fs-5 text-muted" for="profile_picture">Profile picture</label>
                        <input name="profile_picture" type="file" class="form-control" id="profile_picture" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="about" class="form-label fw-bold fs-5 text-muted">About</label>
                        <textarea name="about" class="form-control" id="about" rows="5">@isset($student->about) {{ $student->about }}@endisset</textarea>
                    </div>

                    <button name="" type="submit" class="btn btn-warning align-self-end">Save changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection