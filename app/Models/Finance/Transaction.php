<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
