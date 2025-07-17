<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Finance\Asset;

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
