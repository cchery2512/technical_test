<?php

namespace App\Strategy\Staff;

use App\Http\Requests\PersonalRequest;
use App\Http\Requests\PersonalUpdateRequest;
use App\Models\User;

interface StaffStrategy
{
    public function create(PersonalRequest $request): User;

    public function show(User $user): User;

    public function update(User $user, PersonalUpdateRequest $request): User;
}
