<?php

namespace App\Enums\Finance;

use Filament\Support\Contracts\HasLabel;

enum Instrument: string implements HasLabel
{
    case CURRENCY = 'currency';
    case STOCK = 'stock';
    case BOND = 'bond';
    case COMMODITIES = 'commodities';
    case CRYPTOCURRENCIES = 'cryptocurrencies';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::CURRENCY => __('Waluta'),
            self::STOCK => __('Akcje'),
            self::BOND => __('Obligacje'),
            self::COMMODITIES => __('Surowce'),
            self::CRYPTOCURRENCIES => __('Kryptowaluty')
        };
    }
}
