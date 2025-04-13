<x-filament-panels::page>
    <x-filament-panels::resources.relation-managers
        :active-manager="$this->activeRelationManager"
        :managers="$relationManagers"
        :owner-record="$record"
        :page-class="static::class"
    />
</x-filament-panels::page>
