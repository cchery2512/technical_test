<?php

namespace Database\Factories;

use App\Models\Date;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DateFactory extends Factory
{
    protected $model = Date::class;

    public function definition(): array
    {
        return [
            'type_date' => $this->faker->randomElement(['date_starting_service', 'date_birth']),
            'date' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
        ];
    }
}
