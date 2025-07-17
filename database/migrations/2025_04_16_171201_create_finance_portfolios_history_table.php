<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finance_portfolios_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained('finance_portfolios')->onDelete('cascade');
            $table->decimal('value', 12, 2);
            $table->date('day');

            $table->unique(['id', 'portfolio_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finance_portfolios_history');
    }
};