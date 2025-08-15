<?php

namespace App\Filament\Resources\Finance\TransactionResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Finance\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
