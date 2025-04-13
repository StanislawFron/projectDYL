<?php

namespace App\Filament\Resources\Finance\PortfolioResource\Pages;

use App\Filament\Resources\Finance\PortfolioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ListPortfolios extends ListRecords
{
    protected static string $resource = PortfolioResource::class;

    protected static string $view = 'filament.resources.portfolio.pages.list-portfolio';

    public function getHeading(): string|Htmlable
    {
        return __('Portfolio');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PortfolioResource\Widgets\TotalProfit::class,
            PortfolioResource\Widgets\DailyProfit::class,
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('Nazwa')),
                TextColumn::make('contributions_netto')->label(__('Wpłaty netto')),
                TextColumn::make('account_value')->label(__('Wartość konta')),
            ]);
    }
}
