<?php

namespace App\Filament\Resources\Finance\Portfolios\Pages;

use App\Filament\Resources\Finance\Portfolios\PortfolioResource;
use App\Filament\Resources\Finance\Portfolios\Widgets\DailyProfit;
use App\Filament\Resources\Finance\Portfolios\Widgets\TotalProfit;
use App\Filament\Resources\Finance\Transactions\TransactionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewPortfolio extends ViewRecord
{
    protected static string $resource = PortfolioResource::class;

    protected string $view = 'filament.resources.portfolio.pages.view-portfolio';

    public function getBreadcrumb(): string
    {
        return $this->getRecord()->name;
    }

    public function getHeading(): string|Htmlable
    {
        return $this->getRecord()->name;
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make('createCategory')
                ->label(__('Dodaj transakcje'))
                ->icon('heroicon-o-plus')
                ->color('primary')
                ->url(fn () => TransactionResource::getUrl('create', ['portfolio_id' => $this->record->getKey()])),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TotalProfit::class,
            DailyProfit::class,
        ];
    }
}
