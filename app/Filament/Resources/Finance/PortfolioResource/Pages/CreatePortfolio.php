<?php

namespace App\Filament\Resources\Finance\PortfolioResource\Pages;

use App\Filament\Resources\Finance\PortfolioResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolio extends CreateRecord
{
    protected static string $resource = PortfolioResource::class;

    public function Form(Form $form): Form
    {
        return $form->schema([
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
