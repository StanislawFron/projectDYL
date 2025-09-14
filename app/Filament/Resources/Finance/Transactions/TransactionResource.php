<?php

namespace App\Filament\Resources\Finance\Transactions;

use App\Enums\Finance\Instrument;
use App\Enums\Finance\TransactionType;
use App\Filament\Resources\Finance\Transactions\Pages\CreateTransaction;
use App\Filament\Resources\Finance\Transactions\Pages\EditTransaction;
use App\Models\Finance\Asset;
use App\Models\Finance\Transaction;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    protected static string|\UnitEnum|null $navigationGroup = 'Portfolio';

    public static function Form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1)->schema([
                    Grid::make()->schema([
                        Hidden::make('portfolio_id')
                            ->default(fn () => request()->query('portfolio_id'))
                            ->required(),
                    ]),
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
                        TextInput::make('asset_id')
                            ->label(__('Ticker'))
                            ->required()
                            ->datalist(Asset::all()->pluck('ticker', 'id'))
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'create' => CreateTransaction::route('/create'),
            'edit' => EditTransaction::route('/{record}/edit'),
        ];
    }
}
