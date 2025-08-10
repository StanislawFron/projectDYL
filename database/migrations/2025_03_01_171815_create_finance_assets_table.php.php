<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finance_assets', function (Blueprint $table) {
            $table->id();
            $table->string('ticker', 16)->unique();
            $table->decimal('value', 16, 8)->default(0.00);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finance_assets');
    }
};
