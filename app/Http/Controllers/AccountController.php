<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountUpdateRequest;
use App\Http\Requests\PersonalUpdateRequest;
use App\Http\Resources\UserResource;

use Facades\App\Services\Staff\Staff;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return new UserResource(Staff::show($user));
    }

    public function update(AccountUpdateRequest $request)
    {
        $user = Auth::user();
        $request = PersonalUpdateRequest::createFrom($request);
        return new UserResource(Staff::update($user, $request));
    }
}