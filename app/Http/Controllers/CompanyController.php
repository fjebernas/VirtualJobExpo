<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Show the initial setup form
     *
     * @return \Illuminate\Http\Response
     */
    public function setup() 
    {
        return view('company.setup');
    }

    /**
     * Show the company's dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard() 
    {
        return view('company.dashboard')
                ->with('company', Auth::user()->company);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company) 
    {
        return view('company.profile.show')
                ->with('company', $company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company) 
    {
        return view('company.profile.edit')
                ->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company) 
    {
        $validated = $request->validate([
            'name' => ['required'],
            'industry' => ['required'],
            'address' => ['required'],
            'contact_number' => ['required'],
            'profile_picture' => ['nullable', 'mimes:png,jpg,jpeg'],
            'about' => ['nullable'],
        ]);

        $new_profile_picture_path = $this->getProfilePicturePath($request->profile_picture);

        $company->update([
            'name' => $request->name,
            'industry' => $request->industry,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'profile_picture_path' => $new_profile_picture_path,
            'about' => $request->about,
        ]);

        return redirect('/company/dashboard')
            ->with('notification', [
                'message' => 'Profile successfully updated',
                'type' => 'success'
            ]);
    }

    public function getProfilePicturePath($profile_picture)
    {
        if (isset($profile_picture))
        {
            // custom image name
            $new_profile_picture_name = $this->getFormattedProfilePictureName($profile_picture);

            // if there is already a profile picture in public, delete it
            $this->deleteProfilePictureIfExists($new_profile_picture_name);

            // move the image file to public/img/profile-pictures
            $this->storeProfilePictureToDisk($new_profile_picture_name, $profile_picture);

            return $new_profile_picture_name;
        } 
        else 
        {
            return 'placeholder.png';
        }
    }

    public function getFormattedProfilePictureName($profile_picture)
    {
        return 'company' .
                '-' .  
                Auth::user()->company->id . 
                '.' .
                $profile_picture->extension();
    }

    public function deleteProfilePictureIfExists($new_profile_picture_name)
    {
        $new_profile_picture_name_without_extension = Str::of($new_profile_picture_name)->before('.');
        if (str_contains(Auth::user()->company->profile_picture_path, $new_profile_picture_name_without_extension)) 
        {
            Storage::disk('local')->delete('public/companies/images/' . Auth::user()->company->profile_picture_path);
        }
    }

    public function storeProfilePictureToDisk($new_profile_picture_name, $profile_picture)
    {
        $store_success = Storage::disk('local')->put('public/companies/images/' . $new_profile_picture_name, 
                        File::get($profile_picture)) ? true : false;

        return $store_success;
    }
}
