<?php

namespace Database\Seeders\Finance;

use App\Models\Finance\Asset;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        $tickers = [
            'WSE:KTY',
            'WSE:PKN',
            'LON:EMIM',
            'LON:CSPX',
            'NASDAQ:INTC',
            'NASDAQ:NVDA',
            'FRA:SC0K',
            'FRA:IUSQ',
        ];

        foreach ($tickers as $ticker) {
            Asset::create([
                'ticker' => $ticker,
                'value' => 0,
            ]);
        }

        Artisan::call('finances:fetch-assets-data');
    }
}
