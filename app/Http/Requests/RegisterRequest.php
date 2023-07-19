<?php

namespace App\Http\Requests;

use App\Enums\RoleEnum;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\In;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:125',
            'surname' => 'required|string|max:125',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'typeOfStaff' => [
                'required',
                new In([RoleEnum::Participant->value, RoleEnum::Journalist->value])
            ]
        ];
    }

    public function authorize(): bool
    {
        return Auth::guest();
    }
}
