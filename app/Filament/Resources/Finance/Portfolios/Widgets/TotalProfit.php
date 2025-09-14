<?php

namespace App\Filament\Resources\Finance\Portfolios\Widgets;

use Filament\Widgets\LineChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class TotalProfit extends LineChartWidget
{
    public function getHeading(): string|Htmlable|null
    {
        return new HtmlString('<h4 class="text-gray-500 font-medium">Wartość całkowita</h4>');
    }

    public function getDescription(): string|Htmlable|null
    {
        return new HtmlString('<h1 class="text-3xl font-semibold">18453.22zł</h1>
                <span class="text-green-500">1002.06 (+6.07%)</span>');
    }

    /**
     * Zwraca konfigurację danych wykresu (Chart.js).
     */
    protected function getData(): array
    {
        return [
            'labels' => [
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
            ],
            'datasets' => [
                [
                    'label' => 'Wartość całkowita',
                    'data' => [0, 100, 500, 1000, 1500, 2200, 2100, 1900, 1400, 900, 1200, 1300, 1900],
                    'borderColor' => '#22c55e',
                    'backgroundColor' => 'rgba(34,197,94,0.2)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
        ];
    }

    /**
     * Opcje konfiguracyjne Chart.js (np. skale, legenda itp.)
     */
    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
        ];
    }
}
