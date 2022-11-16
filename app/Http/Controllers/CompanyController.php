<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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

    public function show(Company $company) 
    {
        return view('company.profile.show')
                ->with('company', $company);
    }

    public function edit(Company $company) 
    {
        return view('company.profile.edit')
                ->with('company', $company);
    }

    public function update(Request $request, Company $company) 
    {
        if (isset($request->profile_picture))
        {
            // custom image name
            $new_profile_picture_name = 'company' .
                                        '-' . 
                                        Auth::user()->company->id . 
                                        '.' .
                                        $request->profile_picture->extension();

            // if there is already a profile picture in public, delete it
            $new_profile_picture_name_without_extension = Str::of($new_profile_picture_name)->before('.');
            if (File::exists(public_path('img/profile-picture/company/' . $new_profile_picture_name_without_extension))) 
            {
            File::delete(public_path('img/profile-picture/company/' . $new_profile_picture_name_without_extension));
            }

            // move the image file to public/img/profile-pictures
            $request->profile_picture->move(public_path('img/profile-picture/company'), $new_profile_picture_name);
        } 
        else 
        {
            $new_profile_picture_name = 'placeholder.png';
        }

        $company->update([
            'name' => $request->name,
            'industry' => $request->industry,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'profile_picture_path' => $new_profile_picture_name,
            'about' => $request->about,
        ]);

        return redirect('/company/dashboard')
            ->with('notification', [
                'message' => 'Profile successfully updated',
                'type' => 'success'
            ]);
    }
}
