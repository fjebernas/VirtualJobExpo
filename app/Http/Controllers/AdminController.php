<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function edit()
    {
        return view('admin.admins.edit');
    }

    public function update(Request $request)
    {
        
    }
}
