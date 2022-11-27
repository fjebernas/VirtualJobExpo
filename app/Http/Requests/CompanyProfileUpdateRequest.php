<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CompanyProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->company;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
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
            'name' => ['required'],
            'industry' => ['required'],
            'address' => ['required'],
            'contact_number' => ['nullable', 'numeric', 'min_digits:11', 'max_digits:11'],
            'profile_picture' => ['nullable', 'mimes:png,jpg,jpeg'],
            'about' => ['nullable', 'string', 'min:20', 'max:300'],
        ];
    }
}
