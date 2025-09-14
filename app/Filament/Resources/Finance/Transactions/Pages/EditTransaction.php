<?php

namespace App\Filament\Resources\Finance\Transactions\Pages;

use App\Filament\Resources\Finance\Portfolios\PortfolioResource;
use App\Filament\Resources\Finance\Transactions\TransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected static ?string $navigationLabel = 'Edytuj transakcje';

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    public function getBreadcrumbs(): array
    {
        return [
            PortfolioResource::getUrl('view', ['record' => $this->record->portfolio]).'?tab=transactions' => $this->record->portfolio->name,
            'Edytuj transakcję',
        ];
    }

    protected function getRedirectUrl(): string
    {
        return PortfolioResource::getUrl('view', [
            'record' => $this->record->portfolio ?? null,
        ]).'?tab=transactions';
    }
}
