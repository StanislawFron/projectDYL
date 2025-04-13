<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
