<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Date;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $check = User::where('email', 'email@example.com')->first();
        if (!$check)
            User::factory()
                ->has(
                    Date::factory()
                        ->count(1)
                        ->state([
                            'type_date' => 'date_starting_service'
                        ]),
                    'date'
                )
                ->create([
                    'email' => 'email@example.com'
                ])->assignRole(RoleEnum::Administrator->value);
    }
}
