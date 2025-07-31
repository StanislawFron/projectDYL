<?php

use App\Models\Finance\Portfolio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('Portfolio - list as user', function () {
    // Arrange
    $user = User::factory()->create();

    // Act
    $result = $this->actingAs($user)->get(
        route('filament.admin.resources.finance.portfolios.index')
    );

    // Assert
    $result->assertOk();
});

test('Portfolio - factory create', function () {
    // Arrange
    $portfolio = Portfolio::factory()->create();

    // Act
    $result = [
        'id' => $portfolio->id,
        'name' => $portfolio->name,
        'user_id' => $portfolio->user_id,
    ];

    // Assert
    $this->assertDatabaseHas('finance_portfolios', $result);
});
