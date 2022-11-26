<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyProfileUpdateRequest;
use App\Models\Company;
use App\Models\ProfilePicture;
use App\Services\ProfilePictureService;
use Illuminate\Support\Facades\Auth;

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
     * @param  \App\Http\Requests\CompanyProfileUpdateRequest  $request
     * @param  \App\Services\ProfilePictureService $profilePictureService
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyProfileUpdateRequest $request, ProfilePictureService $profilePictureService, Company $company) 
    {
        $company->update($request->all());

        $profilePictureService->handleProfilePicture($request->profile_picture);

        ProfilePicture::updateOrCreate(
            ['user_id' => Auth::user()->id],
            ['path' => $profilePictureService->getPathOf($request->profile_picture)]
        );

        return redirect('/company/dashboard')
            ->with('notification', [
                'message' => 'Profile successfully updated',
                'type' => 'success'
            ]);
    }
}
