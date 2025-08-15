<?php

namespace App\Filament\Resources\Finance\PortfolioResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Finance\PortfolioResource;
use App\Filament\Resources\Finance\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewPortfolio extends ViewRecord
{
    protected string $view = 'filament.resources.portfolio.pages.view-portfolio';

    protected static string $resource = PortfolioResource::class;

    public function getBreadcrumb(): string
    {
        return $this->getRecord()->name;
    }

    public function getHeading(): string|Htmlable
    {
        return $this->getRecord()->name;
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make('createCategory')
                ->label(__('Dodaj transakcje'))
                ->icon('heroicon-o-plus')
                ->url(fn () => TransactionResource::getUrl('create', ['portfolio_id' => $this->record->getKey()])),
        ];
    }

    protected function getViewData(): array
    {
        return array_merge(parent::getViewData(), [
            'relationManagers' => static::getResource()::getRelations(),
            'activeRelationManager' => data_get(static::getResource()::getRelations(), 0),
        ]);
    }
}
