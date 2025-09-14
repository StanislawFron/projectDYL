<div>
    <div class="border border-indigo-900 rounded-lg p-4 mb-6">
        <div class="flex justify-center gap-2">
            @foreach ($tabs as $key => $label)
                <x-filament::button
                    wire:click="setTab('{{ $key }}')"
                    size="sm"
                    color="secondary"
                    class="
                    text-white
                    hover:bg-indigo-600
                    transition-colors duration-200
                    {{ ($activeTab ?? '') === $key ? 'bg-indigo-600' : 'bg-indigo-900' }}
                "
                >
                    {{ $label }}
                </x-filament::button>
            @endforeach
        </div>
    </div>

@if($activeTab === 'assets')
        @livewire('finance.portfolio.assets-table', ['portfolio' => $portfolio])
    @elseif($activeTab === 'transactions')
        @livewire('finance.portfolio.transactions-table', ['portfolio' => $portfolio])
    @endif
</div>
