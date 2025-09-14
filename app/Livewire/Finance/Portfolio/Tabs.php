<?php

namespace App\Livewire\Finance\Portfolio;

use App\Models\Finance\Portfolio;
use Livewire\Component;

class Tabs extends Component
{
    public ?string $activeTab = null;

    public Portfolio $portfolio;

    public function setTab(string $tab): void
    {
        if (! array_key_exists($tab, $this->getTabs())) {
            abort(404);
        }

        $this->activeTab = $tab;
    }

    public function mount(Portfolio $portfolio)
    {
        $this->portfolio = $portfolio;
        $tab = request()->query('tab');

        if ($tab && array_key_exists($tab, $this->getTabs())) {
            $this->activeTab = $tab;
        }
    }

    public function getTabs(): array
    {
        return [
            null => 'Podstawowe informacje',
            'assets' => 'Aktywa',
            'transactions' => 'Transakcje',
        ];
    }

    public function render()
    {
        return view('livewire.finance.portfolio.tabs', [
            'tabs' => $this->getTabs(),
        ]);
    }
}
