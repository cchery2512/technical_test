<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonalUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:125',
            'surname' => 'required|string|max:125',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('staff')->id)
            ]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
