<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PersonalRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Facades\App\Services\Staff\Staff;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            throw ValidationException::withMessages([
                'auth' => ['The provided credentials are incorrect.'],
            ]);
        }

        return new LoginResource(Auth::user());
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $request = PersonalRequest::createFrom($request);
        return new UserResource(Staff::create($data['typeOfStaff'], $request));
    }
}
