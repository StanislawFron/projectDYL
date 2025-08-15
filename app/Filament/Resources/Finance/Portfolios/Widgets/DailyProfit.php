<?php

namespace App\Filament\Resources\Finance\Portfolios\Widgets;

use Filament\Widgets\LineChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class DailyProfit extends LineChartWidget
{
    public function getHeading(): string|Htmlable|null
    {
        return new HtmlString('<h4 class="text-gray-500 font-medium">Zysk dzienny</h4>');
    }

    public function getDescription(): string|Htmlable|null
    {
        return new HtmlString('<h1 class="text-3xl font-semibold">102.06</h1>
                <span class="text-green-500">(+0.57%)</span>');
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
            ],
            'datasets' => [
                [
                    'label' => 'Zysk całkowity',
                    'data' => [0, -20, -40, 10, 40, 20, 50, 102.06],
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
