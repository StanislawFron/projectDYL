<?php

namespace App\Console\Commands;

use App\Models\Finance\Asset;
use Illuminate\Console\Command;

class FetchAssetsData extends Command
{
    protected $signature = 'finances:fetch-assets-data';

    protected $description = 'Fetch assets data from external API';

    public function handle()
    {
        $assets = Asset::all();

        foreach ($assets as $asset) {
            $asset->update([
                'value' => rand(1, 100),
            ]);
        }
    }
}
