<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StudentProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->role == 'student';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'regex:/^[\pL\s\-]+$/u'],
            'middle_name' => ['nullable', 'alpha'],
            'last_name' => ['required', 'alpha'],
            'birthdate' => ['nullable', 'date'],
            'gender' => ['required', Rule::in([
                                                'male',
                                                'female',
                                            ])],
            'university' => ['required', 'regex:/^[\pL\s\-]+$/u'],
            'contact_number' => ['nullable'],
            'profile_picture' => ['nullable', 'mimes:png,jpg,jpeg'],
            'about' => ['nullable'],
        ];
    }
}
