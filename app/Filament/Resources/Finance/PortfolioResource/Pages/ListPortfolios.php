<?php

namespace App\Filament\Resources\Finance\PortfolioResource\Pages;

use App\Enums\Finance\TransactionType;
use App\Filament\Resources\Finance\PortfolioResource;
use App\Filament\Resources\Finance\PortfolioResource\Widgets\DailyProfit;
use App\Filament\Resources\Finance\PortfolioResource\Widgets\TotalProfit;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class ListPortfolios extends ListRecords
{
    protected static string $resource = PortfolioResource::class;

    protected string $view = 'filament.resources.portfolio.pages.list-portfolio';

    public function getHeading(): string|Htmlable
    {
        return __('Portfolio');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TotalProfit::class,
            DailyProfit::class,
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('Nazwa')),
                TextColumn::make('transactions_sum')
                    ->label(__('Wpłaty netto'))
                    ->getStateUsing(fn ($record) => $record->transactions()->where('type', TransactionType::DEPOSIT)->get()->sum(function ($transaction) {
                        return $transaction->getValue();
                    }))
                    ->money('PLN'),
                TextColumn::make('account_value')
                    ->label(__('Wartość konta'))
                    ->getStateUsing(fn ($record) => $record->getValue())
                    ->money('PLN'),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
