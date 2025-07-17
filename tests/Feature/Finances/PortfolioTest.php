<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Finance\Portfolio;


uses(RefreshDatabase::class);

test('Portfolio - list as user', function () {
   // Arrange
   $user = \App\Models\User::factory()->create();

   // Act
   $result = $this->actingAs($user)->get(route('filament.admin.resources.finance.portfolios.index'));

   // Assert
   $result->assertOk();
});

test('Portfolio - factory create', function () {
   // Arrange
   $portfolioFactory = Portfolio::factory();

   // Act
   $portfolio = $portfolioFactory->create();

   // Assert
   $this->assertDatabaseHas('finance_portfolios', [
       'id' => $portfolio->id,
       'name' => $portfolio->name,
       'user_id' => $portfolio->user_id,
   ]);
});
