<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function dashboard() {
        return view('company.dashboard');
    }

    public function view() {
        return view('company.view')
                ->with('company', Company::where('email', Auth::user()->email)->firstOrFail());
    }

    public function edit() {
        return view('company.edit')
                ->with('company', Company::where('email', Auth::user()->email)->firstOrFail());
    }

    public function update(Request $request) {
        Company::where('email', Auth::user()->email)
            ->update([
                'name' => $request->name,
                'industry' => $request->industry,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
            ]);

        return redirect('/company/edit')
            ->with('notification', [
                'message' => 'Profile successfully updated',
                'type' => 'success'
            ]
        );
    }
}
