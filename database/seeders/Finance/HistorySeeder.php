<?php

namespace Database\Seeders\Finance;

use App\Models\Finance\History;
use App\Models\Finance\Transaction;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    public function run(): void
    {
        $transactions = Transaction::all();

        foreach ($transactions as $transaction) {
            History::create([
                'portfolio_id' => $transaction->portfolio_id,
                'value' => $transaction->value,
                'day' => $transaction->created_at->format('Y-m-d'),
            ]);
        }
    }
}