<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyHistory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'finance_portfolios_daily_history';
}
