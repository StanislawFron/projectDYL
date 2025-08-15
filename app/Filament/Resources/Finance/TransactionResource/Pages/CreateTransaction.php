<?php

namespace App\Filament\Resources\Finance\TransactionResource\Pages;

use App\Enums\Finance\Instrument;
use App\Enums\Finance\TransactionType;
use App\Filament\Resources\Finance\TransactionResource;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    public function Form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1)->schema([
                    Grid::make()->schema([
                        Select::make('type')
                            ->label(__('Typ transakcji'))
                            ->options(TransactionType::class)
                            ->required()
                            ->columnSpan(1),
                    ]),
                    Grid::make()->schema([
                        DatePicker::make('date')
                            ->label(__('Data transakcji'))
                            ->maxDate(Carbon::now())
                            ->default(Carbon::now())
                            ->required()
                            ->columnSpan(1),
                    ]),
                    Grid::make()->schema([
                        Select::make('instrument')
                            ->label(__('Klasa aktywów'))
                            ->options(Instrument::class)
                            ->required()
                            ->columnSpan(1),
                    ]),
                    Grid::make()->schema([
                        TextInput::make('ticker')
                            ->label(__('Ticker'))
                            ->required()
                            ->datalist([
                                'Technologia',
                                'Zdrowie',
                                'Edukacja',
                                'Sport',
                                'Biznes',
                            ])
                            ->placeholder('Wpisz lub wybierz...')
                            ->columnSpan(1),
                    ]),
                    Grid::make()->schema([
                        TextInput::make('volume')
                            ->label(__('Liczba jednostek'))
                            ->required()
                            ->minValue(0)
                            ->numeric()
                            ->step(0.0001)
                            ->columnSpan(1),
                    ]),
                    Grid::make()->schema([
                        TextInput::make('value')
                            ->label(__('Cena'))
                            ->required()
                            ->minValue(0)
                            ->numeric()
                            ->step(0.0001)
                            ->columnSpan(1),
                    ]),
                ]),
            ]);
    }

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['currency'] = 'PLN';
        $data['name'] = 'KTY';
        $data['portfolio_id'] = 1;

        return $data;
    }
}
