<?php

namespace App\Services;

use App\Models\ProfilePicture;
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

            $this->storeRecord($new_profile_picture_name);
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

            $this->deleteRecord();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $new_profile_picture_name
     * @param Illuminate\Http\UploadedFile $profile_picture
     * @return bool
     */
    public function storeProfilePictureToDisk($new_profile_picture_name, $profile_picture)
    {
        return Storage::disk('local')->put('public/' . 
                                            Str::plural(Auth::user()->role) . '/' .
                                            'images/' . 
                                            $new_profile_picture_name, 
                                            
                                            File::get($profile_picture));
    }

    public function storeRecord($new_profile_picture_name)
    {
        ProfilePicture::create([
            'path' => $new_profile_picture_name,
            'user_id' => Auth::user()->id,
        ]);
    }

    public function deleteRecord()
    {
        ProfilePicture::where('user_id', Auth::user()->id)->delete();
    }
}