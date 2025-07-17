<?php

namespace Database\Seeders\Finance;

use App\Enums\Finance\TransactionType;
use App\Models\Finance\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        Transaction::factory()->count(90)->create()->each(function ($transaction) {
            Transaction::create([
                'portfolio_id' => $transaction->portfolio_id,
                'type' => TransactionType::DEPOSIT->value,
                'date' => $transaction->date,
                'instrument' => $transaction->instrument,
                'asset_id' => $transaction->asset_id,
                'name' => $transaction->name,
                'currency' => $transaction->currency,
                'volume' => $transaction->volume,
                'value' => $transaction->value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        foreach (range(1, 10) as $i) {
            $transaction = Transaction::factory()->create([
                'date' => now()->setTime(rand(0, 23), rand(0, 59)),
            ]);

            Transaction::create([
                'portfolio_id' => $transaction->portfolio_id,
                'type' => TransactionType::DEPOSIT->value,
                'date' => $transaction->date,
                'instrument' => $transaction->instrument,
                'asset_id' => $transaction->asset_id,
                'name' => $transaction->name,
                'currency' => $transaction->currency,
                'volume' => $transaction->volume,
                'value' => $transaction->value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
