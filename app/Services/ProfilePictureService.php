<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfilePictureService 
{
    public function handleProfilePicture($profile_picture)
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
    }

    public function getFormattedProfilePictureName($profile_picture)
    {
        return isset($profile_picture) ? 'user' .
                                            '-' .  
                                            Auth::user()->id . 
                                            '.' .
                                            $profile_picture->extension()

                                        : 'placeholder.png';
    }

    public function deleteProfilePictureIfExists($new_profile_picture_name)
    {
        $new_profile_picture_name_without_extension = Str::of($new_profile_picture_name)->before('.');
        if (Auth::user()->student)
        {
            if (str_contains(Auth::user()->student->profile_picture_path, $new_profile_picture_name_without_extension)) 
            {
                Storage::disk('local')->delete('public/' . 
                                                Str::plural(Auth::user()->role) . 
                                                Auth::user()->student->profile_picture_path);
            }
        }
        else if (Auth::user()->company)
        {
            if (str_contains(Auth::user()->company->profile_picture_path, $new_profile_picture_name_without_extension)) 
            {
                Storage::disk('local')->delete('public/' . 
                                                Str::plural(Auth::user()->role) . 
                                                Auth::user()->student->profile_picture_path);
            }
        }
    }

    public function storeProfilePictureToDisk($new_profile_picture_name, $profile_picture)
    {
        Storage::disk('local')->put('public/' . 
                                    Str::plural(Auth::user()->role) . 
                                    '/images\/' . 
                                    $new_profile_picture_name, 
                                    
                                    File::get($profile_picture));
    }
}