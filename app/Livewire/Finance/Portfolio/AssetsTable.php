<?php

namespace App\Livewire\Finance\Portfolio;

use App\Models\Finance\Portfolio;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\View\View;
use Livewire\Component;

class AssetsTable extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public ?Portfolio $portfolio = null;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => $this->portfolio->transactions()
                ->join('finance_assets', 'finance_transactions.asset_id', '=', 'finance_assets.id')
                ->selectRaw('
                    finance_assets.id AS id,
                    finance_assets.ticker,
                    finance_transactions.currency,
                    SUM(finance_transactions.volume) AS total_volume,
                    SUM(finance_transactions.value) AS total_purchase_value,
                    SUM(finance_transactions.value) / SUM(finance_transactions.volume) AS avg_purchase_price,
                    finance_assets.value AS current_unit_value,
                    (SUM(finance_transactions.volume) * finance_assets.value) - SUM(finance_transactions.value) AS value_diff
                ')
                ->groupBy(
                    'finance_assets.id',
                    'finance_assets.ticker',
                    'finance_assets.value',
                    'finance_transactions.currency'
                )
            )
            ->columns([
                TextColumn::make('ticker')->label('Ticker'),

                TextColumn::make('total_volume')
                    ->label('Wolumen')
                    ->formatStateUsing(fn ($state) => rtrim(rtrim((string) $state, '0'), '.')),

                TextColumn::make('avg_purchase_price')
                    ->label('Średnia wartość zakupu')
                    ->money(fn ($record) => $record->currency),

                TextColumn::make('current_unit_value')
                    ->label('Wartość rynkowa')
                    ->money(fn ($record) => $record->currency),

                TextColumn::make('value_diff')
                    ->label('Zysk netto')
                    ->money(fn ($record) => $record->currency)
                    ->color(fn ($state) => $state < 0 ? 'danger' : 'success'),
            ])
            ->filters([]);
    }

    public function render(): View
    {
        return view('livewire.finance.portfolio.assets-table');
    }
}
