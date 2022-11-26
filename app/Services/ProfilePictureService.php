<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class ProfilePictureService 
{
    /**
     * Display the specified resource.
     *
     * @param Illuminate\Http\UploadedFile $profile_picture
     * @return string $new_profile_picture_name
     */
    public function handleProfilePicture($profile_picture)
    {
        $this->deleteOldProfilePictureIfExists();

        if (isset($profile_picture))
        {
            $new_profile_picture_name = $this->getPathOf($profile_picture);

            $this->storeProfilePictureToDisk($new_profile_picture_name, $profile_picture);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Illuminate\Http\UploadedFile $profile_picture
     * @return string
     */
    public function getPathOf($profile_picture)
    {
        return isset($profile_picture) ? Auth::user()->id . 
                                        '.' .
                                        $profile_picture->extension()

                                        : 'placeholder.png';
    }

    /**
     * Display the specified resource.
     *
     * @param string $new_profile_picture_name
     * @return void
     */
    public function deleteOldProfilePictureIfExists()
    {
        if (Auth::user()->profilePicture && Auth::user()->profilePicture->path != 'placeholder.png')
        {
            Storage::disk('local')->delete('public/' . 
                                            Str::plural(Auth::user()->role) . '/' .
                                            'images/' . 
                                            Auth::user()->profilePicture->path);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $new_profile_picture_name
     * @param Illuminate\Http\UploadedFile $profile_picture
     */
    public function storeProfilePictureToDisk($new_profile_picture_name, $profile_picture)
    {
        Storage::disk('local')->put('public/' . 
                                    Str::plural(Auth::user()->role) . '/' .
                                    'images/' . 
                                    $new_profile_picture_name, 
                                    
                                    File::get($profile_picture));
    }
}