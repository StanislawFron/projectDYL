<?php

namespace Database\Seeders;

use Database\Seeders\Finance\AssetSeeder;
use Database\Seeders\Finance\DailyHistorySeeder;
use Database\Seeders\Finance\HistorySeeder;
use Database\Seeders\Finance\PortfolioSeeder;
use Database\Seeders\Finance\TransactionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AssetSeeder::class,
            PortfolioSeeder::class,
            TransactionSeeder::class,
            HistorySeeder::class,
            DailyHistorySeeder::class,
        ]);
    }
}
