<?php

namespace App\Livewire\Finance\Portfolio;

use App\Enums\Finance\Instrument;
use App\Enums\Finance\TransactionType;
use App\Filament\Resources\Finance\Transactions\TransactionResource;
use App\Models\Finance\Portfolio;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\DeleteAction;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\View\View;
use Livewire\Component;

class TransactionsTable extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public ?Portfolio $portfolio = null;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => $this->portfolio->transactions())
            ->columns([
                TextColumn::make('date')
                    ->label('Data')
                    ->date('d.m.Y'),
                TextColumn::make('type')->label('Typ')
                    ->getStateUsing(fn ($record) => TransactionType::tryFrom($record->type)->getLabel()),
                TextColumn::make('instrument')->label('Instrument')
                    ->getStateUsing(fn ($record) => Instrument::tryFrom($record->instrument)->getLabel()),
                TextColumn::make('asset.ticker')->label('Ticker'),
                TextColumn::make('volume')
                    ->label('Ilość')
                    ->formatStateUsing(fn ($state) => rtrim(rtrim((string) $state, '0'), '.')),
                TextColumn::make('value')->label('Kwota')
                    ->money(fn ($record) => $record->currency),
            ])
            ->recordActions([
                Action::make('edit')
                    ->label('Edytuj')
                    ->icon('heroicon-o-pencil')
                    ->url(fn ($record) => TransactionResource::getUrl('edit', [$record->id]))
                    ->openUrlInNewTab(false),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Czy na pewno chcesz usunąć tę transakcję?')
                    ->successNotificationTitle('Transakcja została usunięta'),
            ])
            ->filters([]);
    }

    public function render(): View
    {
        return view('livewire.finance.portfolio.assets-table');
    }
}
