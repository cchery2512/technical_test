<?php

namespace App\Services\Staff;

use App\Enums\RoleEnum;
use App\Http\Requests\PersonalRequest;
use App\Http\Requests\PersonalUpdateRequest;
use App\Models\User;

class ParticipantStaff implements StaffStrategy
{

    /**
     * @param PersonalRequest $request
     * @return User
     */
    public function create(PersonalRequest $request): User
    {
        $data = $request->validate([
            ...$request->rules(),
            'date_birth' => 'required|date|before:today'
        ]);

        $user = User::create($data);
        $user->date()->create([
            'date' => $data['date_birth'],
            'type_date' => 'date_birth'
        ]);

        $user->assignRole(RoleEnum::Participant->value);

        return $user->load('date');
    }

    public function show(User $user): User
    {
        return $user->load('date');
    }

    public function update(User $user, PersonalUpdateRequest $request): User
    {
        $data = $request->validate([
            ...$request->rules(),
            'date_birth' => 'required|date|before:today'
        ]);

        $user->update($data);

        if ($user->date) {
            $user->date->date = $data['date_birth'];
            $user->date->save();
        }

        return $user->loadMissing('date');
    }


}
