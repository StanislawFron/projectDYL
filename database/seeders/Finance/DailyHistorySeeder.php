<?php

namespace Database\Seeders\Finance;

use App\Models\Finance\DailyHistory;
use App\Models\Finance\Transaction;
use Illuminate\Database\Seeder;

class DailyHistorySeeder extends Seeder
{
    public function run(): void
    {
        $transactions = Transaction::whereDate('created_at', now()->toDateString())->get();

        foreach ($transactions as $transaction) {
            DailyHistory::create([
                'portfolio_id' => $transaction->portfolio_id,
                'value' => $transaction->value,
                'hour' => $transaction->created_at,
            ]);
        }
    }
}
