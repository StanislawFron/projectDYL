<?php

namespace Database\Factories\Finance;

use App\Models\Finance\Portfolio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioFactory extends Factory
{
    protected $model = Portfolio::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(1, true),
            'user_id' => User::factory(),
        ];
    }
}
