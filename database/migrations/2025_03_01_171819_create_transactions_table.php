<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained(table: 'portfolios')->onDelete('cascade');
            $table->string('type', 32);
            $table->date('date');
            $table->string('instrument',16);
            $table->string('ticker', 16);
            $table->string('name');
            $table->char('currency',3 );
            $table->decimal('volume', 38, 20);
            $table->decimal('value', 20, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
