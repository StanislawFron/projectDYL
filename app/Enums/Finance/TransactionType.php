<?php

namespace App\Enums\Finance;

use Filament\Support\Contracts\HasLabel;

enum TransactionType: string implements HasLabel {
    case BUY = 'buy';
    case SELL = 'sell';
    case DEPOSIT = 'deposit';
    case WITHDRAWAL = 'withdrawal';
    case DIVIDEND = 'dividend';
    case INTEREST = 'interest';

    public function getLabel(): ?string
    {
        return match($this){
            self::BUY => __('Zakup'),
            self::SELL => __('Sprzedaż'),
            self::DEPOSIT => __('Wpłata'),
            self::WITHDRAWAL => __('Wypłata'),
            self::DIVIDEND => __('Dywidenda'),
            self::INTEREST => __('Odsetki')
        };
    }
}
