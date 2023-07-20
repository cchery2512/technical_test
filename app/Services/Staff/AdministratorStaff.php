<?php

namespace App\Services\Staff;

use App\Enums\RoleEnum;
use App\Http\Requests\PersonalRequest;
use App\Http\Requests\PersonalUpdateRequest;
use App\Models\User;

class AdministratorStaff implements StaffStrategy
{

    public function create(PersonalRequest $request): User
    {
        $data = $request->validate([
            ...$request->rules(),
            'date_starting_service' => 'sometimes|date|before:today'
        ]);

        $user = User::create($data);
        $user->date()->create([
            'date' => $data['date_starting_service'] ?? now(),
            'type_date' => 'date_starting_service'
        ]);
        $user->assignRole(RoleEnum::Administrator->value);

        return $user->loadMissing('date');
    }

    public function show(User $user): User
    {
        return $user->loadMissing('date');
    }

    public function update(User $user, PersonalUpdateRequest $request): User
    {
        $data = $request->validate([
            ...$request->rules(),
            'date_starting_service' => 'required|date|before:tomorrow'
        ]);

        $user->update($data);

        if ($user->date)
        {
            $user->date->date = $data['date_starting_service'];
            $user->date->save();
        }

        return $user->loadMissing('date');
    }


}
