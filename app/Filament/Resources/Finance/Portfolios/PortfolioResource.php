<?php

namespace App\Filament\Resources\Finance\Portfolios;

use App\Filament\Resources\Finance\Portfolios\Pages\CreatePortfolio;
use App\Filament\Resources\Finance\Portfolios\Pages\EditPortfolio;
use App\Filament\Resources\Finance\Portfolios\Pages\ListPortfolios;
use App\Filament\Resources\Finance\Portfolios\Pages\ViewPortfolio;
use App\Models\Finance\Portfolio;
use Filament\Resources\Resource;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-wallet';

    protected static ?int $navigationSort = 1;

    public static function getBreadcrumb(): string
    {
        return __('Portfolio');
    }

    public static function getNavigationLabel(): string
    {
        return __('Portfolio');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Finanse');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPortfolios::route('/'),
            'create' => CreatePortfolio::route('/create'),
            'view' => ViewPortfolio::route('/{record}'),
            'edit' => EditPortfolio::route('/{record}/edit'),
        ];
    }
}
