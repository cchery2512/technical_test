<?php

namespace App\Services\Staff;

use App\Enums\RoleEnum;
use App\Http\Requests\PersonalRequest;
use App\Http\Requests\PersonalUpdateRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class Journalist implements StaffStrategy
{

    public function create(PersonalRequest $request): User
    {
        $data = $request->validate([
            ...$request->rules(),
            'company_id' => 'sometimes|exists:companies,id',
            'company_name' => 'sometimes|unique:companies,name'
        ]);

        if (!isset($data['company_id']) && !isset($data['company_name']))
            throw ValidationException::withMessages([
                'staff' => ['The company not provided.'],
            ]);


        $user = User::create($data);

        if ($request->has('company_id')) {
            $user->companyJournalist()->create(['company_id' => $data['company_id']]);
        } else if ($request->has('company_name')) {
            $company = Company::create(['name' => $data['company_name']]);
            $user->companyJournalist()->create(['company_id' => $company->id]);
        }

        $user->assignRole(RoleEnum::Journalist->value);

        return $user->loadMissing('company');
    }

    public function show(User $user): User
    {
        return $user->loadMissing('company');
    }

    public function update(User $user, PersonalUpdateRequest $request): User
    {
        $data = $request->validate([
            ...$request->rules(),
            'company_id' => 'sometimes|exists:companies,id',
            'company_name' => 'sometimes|unique:companies,name'
        ]);

        if (!isset($data['company_id']) && !isset($data['company_name']))
            throw ValidationException::withMessages([
                'staff' => ['The company not provided.'],
            ]);

        $user->update($data);

        if ($request->has('company_id')) {
            $user->companyJournalist?->delete();
            $user->companyJournalist()->create(['company_id' => $data['company_id']]);
        } else if ($request->has('company_name')) {
            $company = Company::create(['name' => $data['company_name']]);
            $user->companyJournalist?->delete();
            $user->companyJournalist()->create(['company_id' => $company->id]);
        }

        return $user->loadMissing('company');
    }
    
}
