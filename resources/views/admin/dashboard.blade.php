@extends('layouts.app')
    
@section('customcss')
    <link rel="stylesheet" href="/css/admin/dashboard.css">
@endsection
    
@section('customjs')
    <script src="/js/admin/dashboard.js" type="module"></script>
@endsection

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center">
    <div class="greeting w-100 rounded d-flex flex-wrap align-items-center justify-content-between px-4 py-4">
        <div>
            <h1 class="text-warning">Welcome, {{ Auth::user()->admin->username }}.</h1>
            <h2 class="fs-5 text-white">“A year from now you may wish you had started today.” <span class="fst-italic text-muted">—Karen Lamb</span></h2>
        </div>
        <div class="table-responsive">
            <table>
                <thead class="text-warning fs-5">
                    <tr>
                        <td class="text-center text-nowrap border-secondary border-end">Jobs</td>
                        <td class="text-center">Jobs Applied</td>
                    </tr>
                </thead>
                <tbody class="text-white text-center">
                    <tr>
                        <td class="table-responsive border-secondary border-end">
                            <table>
                                <thead class="fs-6 text-muted">
                                    <tr>
                                        <td class="px-2">Available</td>
                                        <td class="px-2 text-nowrap">Saved</td>
                                    </tr>
                                </thead>
                                <tbody class="fs-4">
                                    <tr>
                                        <td>NA</td>
                                        <td>NA</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td class="table-responsive">
                            <table>
                                <thead class="fs-6 text-muted">
                                    <tr>
                                        <td class="px-2">Received</td>
                                        <td class="px-2">Shortlisted</td>
                                        <td class="px-2 text-nowrap border-secondary border-end">Not qualified</td>
                                        <td class="px-2">Total</td>
                                    </tr>
                                </thead>
                                <tbody class="fs-4">
                                    <tr>
                                        <td>NA</td>
                                        <td>NA</td>
                                        <td class="border-secondary border-end">NA</td>
                                        <td>NA</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="cards-container d-flex justify-content-center flex-wrap mt-5">
        <a href='#' class="text-decoration-none">
            <div class="card users d-flex justify-content-center align-items-center border-0">
                <box-icon name='user' size='90px' color='white'></box-icon>
                <h3 class="fs-5">Users</h3>
            </div>
        </a>

        <a href='#' class="text-decoration-none">
            <div class="card students d-flex justify-content-center align-items-center border-0">
                <box-icon type='solid' name='graduation' size='90px' color='white'></box-icon>
                <h3 class="fs-5">Students</h3>
            </div>
        </a>

        <a href='#'
            class="text-decoration-none">
            <div class="card companies d-flex justify-content-center align-items-center border-0">
                <box-icon name='group' size='90px' color='white'></box-icon>
                <h3 class="fs-5">Companies</h3>
            </div>
        </a>

        <a href='#' class="text-decoration-none">
            <div class="card job-posts d-flex justify-content-center align-items-center border-0">
                <box-icon type='solid' name='note' size='90px' color='white'></box-icon>
                <h3 class="fs-5">Job Posts</h3>
            </div>
        </a>

        <a href='#' class="text-decoration-none">
            <div class="card jobs-applications d-flex justify-content-center align-items-center border-0">
                <box-icon name='briefcase' size='90px' color='white'></box-icon>
                <h3 class="fs-5">Job Applications</h3>
            </div>
        </a>
    </div>
</div>
@endsection
