<?php

namespace App\Http\Requests;


use Auth;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string'
        ];
    }

    public function authorize(): bool
    {
        return Auth::guest();
    }
}
