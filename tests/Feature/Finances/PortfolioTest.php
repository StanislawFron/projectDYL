<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('Portfolio - list', function (){
   \App\Models\Finance\Portfolio::factory()->create([

   ]);
});
