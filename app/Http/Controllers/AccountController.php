<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalUpdateRequest;
use App\Http\Resources\UserResource;
use Auth;
use Facades\App\Strategy\Staff\Staff;

class AccountController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return new UserResource(Staff::show($user));
    }

    public function update(PersonalUpdateRequest $request)
    {
        $user = Auth::user();
        return new UserResource(Staff::update($user, $request));
    }
}
