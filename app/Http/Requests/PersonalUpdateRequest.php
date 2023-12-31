<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PersonalUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $user = Auth::user();
        return [
            'name' => 'required|string|max:125',
            'surname' => 'required|string|max:125',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('staff') ? $this->route('staff')->id : $user?->id)
            ]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}