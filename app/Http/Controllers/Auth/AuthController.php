<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use Auth;
use Illuminate\Validation\ValidationException;
use Facades\App\Strategy\Staff\Staff;

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
        return new UserResource(Staff::create($data['typeOfStaff'], $request));
    }
}
