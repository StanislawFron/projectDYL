<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyHistory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'finance_portfolios_daily_history';
}
