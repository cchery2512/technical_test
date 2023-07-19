<?php

namespace App\Strategy\Staff;

use App\Enums\RoleEnum;
use App\Http\Requests\PersonalRequest;
use App\Http\Requests\PersonalUpdateRequest;
use App\Models\User;

class JudgeStaff implements StaffStrategy
{

    public function create(PersonalRequest $request): User
    {
        $data = $request->validate([
            ...$request->rules(),
            'judge_id_number' => 'required|numeric'
        ]);

        $user = User::create($data);
        $user->numberJudge()->create([
            'judge_id_number' => $data['judge_id_number']
        ]);

        $user->assignRole(RoleEnum::Judge->value);

        return $user->load('numberJudge');
    }

    public function show(User $user): User
    {
        return $user->load('numberJudge');
    }

    public function update(User $user, PersonalUpdateRequest $request): User
    {
        $data = $request->validate([
            ...$request->rules(),
            'judge_id_number' => 'required|numeric'
        ]);

        $user->update($data);

        if ($user->numberJudge) {
            $user->numberJudge->judge_id_number = $data['judge_id_number'];
            $user->numberJudge->save();
        }

        return $user->loadMissing('numberJudge');
    }


}
