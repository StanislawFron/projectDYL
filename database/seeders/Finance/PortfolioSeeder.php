<?php

namespace Database\Seeders\Finance;

use App\Models\Finance\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        Portfolio::factory()->count(10)->create();
    }
}
