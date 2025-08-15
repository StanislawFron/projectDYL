<?php

namespace App\Filament\Resources\Finance\PortfolioResource\Pages;

use App\Filament\Resources\Finance\PortfolioResource;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;

class CreatePortfolio extends CreateRecord
{
    protected static string $resource = PortfolioResource::class;

    public function Form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Nazwa')
                ->required(),
        ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
