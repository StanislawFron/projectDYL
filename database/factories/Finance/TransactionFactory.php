<?php

namespace Database\Factories\Finance;

use App\Enums\Finance\Currency;
use App\Enums\Finance\Instrument;
use App\Enums\Finance\TransactionType;
use App\Models\Finance\Asset;
use App\Models\Finance\Portfolio;
use App\Models\Finance\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'portfolio_id' => $this->faker->randomElement(Portfolio::all())->id,
            'type' => TransactionType::BUY->value,
            'date' => $this->faker->date(),
            'instrument' => $this->faker->randomElement(Instrument::cases()),
            'asset_id' => $this->faker->randomElement(Asset::all())->id,
            'name' => $this->faker->word(),
            'currency' => $this->faker->randomElement(Currency::cases()),
            'volume' => $this->faker->randomFloat(2, 1, 100),
            'value' => $this->faker->randomFloat(2, 1, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
