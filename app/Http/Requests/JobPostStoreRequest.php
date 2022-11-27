<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class JobPostStoreRequest extends FormRequest
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
            'position' => Str::title(Str::lower($this->position)),
            'salary_range' => [
                                'low' => $this->salary_range[0],
                                'high' => $this->salary_range[1],
                            ],
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
            'position' => ['required'],
            'location' => ['required'],
            'level' => ['required', Rule::in([
                                                'entry-level',
                                                'intermediate',
                                                'senior',
                                                'internship',
                                            ])],
            'employment' => ['required', Rule::in([
                                                    'full-time',
                                                    'part-time',
                                                ])],
            'salary_range' => ['nullable', 'array:low,high'],
            'description' => ['nullable'],
        ];
    }
}
