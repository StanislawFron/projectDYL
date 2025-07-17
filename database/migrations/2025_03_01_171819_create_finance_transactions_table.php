<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finance_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained(table: 'finance_portfolios')->onDelete('cascade');
            $table->string('type', 32);
            $table->date('date');
            $table->string('instrument',16);
            $table->foreignId('asset_id')->constrained(table: 'finance_assets')->onDelete('cascade');
            $table->string('name');
            $table->char('currency', 3);
            $table->decimal('volume', 38, 20);
            $table->decimal('value', 20, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finance_transactions');
    }
};
