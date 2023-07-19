<?php

namespace App\Http\Requests;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

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
                new Enum(RoleEnum::class)
            ]
        ];
    }

    public function authorize(): bool
    {
        return Auth::guest();
    }
}
