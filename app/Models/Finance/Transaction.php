<?php

namespace App\Models\Finance;

use App\Enums\Finance\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'finance_transactions';

    protected $guarded = [];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function getValue(): float
    {
        $currencyRate = 1;

        return match (TransactionType::from($this->type)) {
            TransactionType::BUY => $this->asset->value * $this->volume * $currencyRate,
            default => $this->value * $this->volume * $currencyRate,
        };
    }
}
