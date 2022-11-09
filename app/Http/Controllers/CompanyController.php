<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function setup() 
    {
        return view('company.setup');
    }

    public function dashboard() 
    {
        return view('company.dashboard');
    }

    public function index() 
    {
        return view('company.profile.index')
                ->with('company', Auth::user()->company);
    }

    public function edit() 
    {
        return view('company.profile.edit')
                ->with('company', Auth::user()->company);
    }

    public function update(Request $request) 
    {
        Auth::user()->company->update([
            'name' => $request->name,
            'industry' => $request->industry,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
        ]);

        return redirect('/company/dashboard')
            ->with('notification', [
                'message' => 'Profile successfully updated',
                'type' => 'success'
            ]);
    }
}
