<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Finance\TransactionType;

class Portfolio extends Model
{
    use HasFactory;
    
    protected $table = 'finance_portfolios';
    
    protected $fillable = ['name', 'user_id'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getValue(): float
    {
        // DEPOZYTY

        $deposits = $this->transactions()
            ->where('type', TransactionType::DEPOSIT)
            ->get()
            ->map(fn(Transaction $transaction) => $transaction->getValue())
            ->sum();

        // AKTUALNIE POSIADANYE AKTYWA

        $instruments = $this->transactions()
            ->where('type', TransactionType::BUY)
            ->get()
            ->map(fn(Transaction $transaction) => $transaction->getValue())
            ->sum();

        // POBIERZ I DODAJ WSZYSTKIE DYWIDENDY I ODSETKI

        $dividends = $this->transactions()
            ->where('type', TransactionType::DIVIDEND)
            ->get()
            ->map(fn(Transaction $transaction) => $transaction->getValue())
            ->sum();

        $intrests = $this->transactions()
            ->where('type', TransactionType::INTEREST)
            ->get()
            ->map(fn(Transaction $transaction) => $transaction->getValue())
            ->sum();  

        // POBIERZ I ODEJMIJ WSZYSTKIE SPRZEDAZE

        $sales = $this->transactions()
            ->where('type', TransactionType::SELL)
            ->get()
            ->map(fn(Transaction $transaction) => $transaction->getValue())
            ->sum();

        // POBIERZ I ODEJMIJ WSZYSTKIE WYPŁATY

        $withdrawals = $this->transactions()
            ->where('type', TransactionType::WITHDRAWAL)
            ->get()
            ->map(fn(Transaction $transaction) => $transaction->getValue())
            ->sum();

        
        return $deposits + $instruments + $dividends + $intrests - $sales - $withdrawals;
    }
}
