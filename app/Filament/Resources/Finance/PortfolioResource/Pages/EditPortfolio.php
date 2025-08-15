<?php

namespace App\Filament\Resources\Finance\PortfolioResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\Finance\PortfolioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortfolio extends EditRecord
{
    protected static string $resource = PortfolioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
