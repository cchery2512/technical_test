<?php

namespace App\Services\Staff;

use App\Http\Requests\PersonalRequest;
use App\Http\Requests\PersonalUpdateRequest;
use App\Models\User;

class Staff
{
    protected array $typeOfStaff = [
        'Administrator' => AdministratorStaff::class,
        'Judge' => JudgeStaff::class,
        'Participant' => ParticipantStaff::class,
        'Journalist' => Journalist::class
    ];

    public function create(string $type, PersonalRequest $request): User
    {
        $strategy = new $this->typeOfStaff[$type];
        $context = new StaffContext($strategy);

        return $context->applyCreate($request);
    }

    public function show(User $user): User
    {
        $user->roles->each(function ($role) use ($user) {
            $strategy = new $this->typeOfStaff[$role->name];
            $context = new StaffContext($strategy);

            $context->applyShow($user);
        });

        return $user;
    }

    public function update(User $user, PersonalUpdateRequest $request): User
    {
        $user->roles->each(function ($role) use ($user, $request) {
            $strategy = new $this->typeOfStaff[$role->name];
            $context = new StaffContext($strategy);

            $context->applyUpdate($user, $request);
        });

        return $user;
    }

}
