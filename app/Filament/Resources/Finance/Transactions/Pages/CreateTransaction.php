<?php

namespace App\Filament\Resources\Finance\Transactions\Pages;

use App\Filament\Resources\Finance\Portfolios\PortfolioResource;
use App\Filament\Resources\Finance\Transactions\TransactionResource;
use App\Models\Finance\Asset;
use App\Models\Finance\Portfolio;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected static ?string $title = 'Utwórz transakcję';

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $portfolio = Portfolio::findOrFail($data['portfolio_id']);
        $this->authorize('createTransaction', $portfolio);

        $data['currency'] = 'PLN';
        $data['name'] = 'Transakcja 1';
        $data['asset_id'] = Asset::firstOrCreate(['ticker' => $data['asset_id']])->id;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return PortfolioResource::getUrl('view', [
            'record' => $this->form->getState()['portfolio_id'] ?? null,
        ]).'?tab=transactions';
    }
}
