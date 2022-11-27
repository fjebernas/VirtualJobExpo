<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class StudentProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->student;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'first_name' => Str::title(Str::lower($this->first_name)),
            'middle_name' => Str::title(Str::lower($this->middle_name)),
            'last_name' => Str::title(Str::lower($this->last_name)),
            'university' => Str::title(Str::lower($this->university)),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'regex:/^[a-zA-Z ]*$/'],
            'middle_name' => ['nullable', 'regex:/^[a-zA-Z ]*$/'],
            'last_name' => ['required', 'regex:/^[a-zA-Z ]*$/'],
            'birthdate' => ['nullable', 'date'],
            'gender' => ['required', Rule::in([
                                                'male',
                                                'female',
                                            ])],
            'university' => ['required', 'regex:/^[\pL\s\-]+$/u'],
            'contact_number' => ['nullable', 'numeric', 'min_digits:11', 'max_digits:11'],
            'profile_picture' => ['nullable', 'mimes:png,jpg,jpeg'],
            'about' => ['nullable', 'string', 'min:20', 'max:300'],
        ];
    }
}
