<?php

namespace App\Enums\Finance;

use Filament\Support\Contracts\HasLabel;

enum Currency: string implements HasLabel
{
    case PLN = 'pln';
    case USD = 'usd';
    case EUR = 'eur';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PLN => __('PLN'),
            self::USD => __('$'),
            self::EUR => __('€')
        };
    }
}
