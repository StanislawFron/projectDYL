<?php

namespace App\Filament\Resources\Finance\PortfolioResource\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactions';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('instrument')->label('Instrument'),
                TextColumn::make('ticker')->label('Ticker'),
                TextColumn::make('amount')->label('Kwota'),
            ])
            ->filters([])
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
