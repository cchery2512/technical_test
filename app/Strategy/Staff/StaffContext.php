<?php

namespace App\Strategy\Staff;

use App\Http\Requests\PersonalRequest;
use App\Http\Requests\PersonalUpdateRequest;
use App\Models\User;

class StaffContext
{
    /**
     * @param StaffStrategy $strategy
     */
    public function __construct(private readonly StaffStrategy $strategy)
    {
    }

    public function applyCreate(PersonalRequest $request)
    {
        return $this->strategy->create($request);
    }

    public function applyShow(User $user): User
    {
        return $this->strategy->show($user);
    }

    public function applyUpdate(User $user, PersonalUpdateRequest $request): User
    {
        return $this->strategy->update($user, $request);
    }
}
