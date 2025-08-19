<x-filament-panels::page>
    <x-filament-panels::form wire:submit="filter">
        {{ $this->form }}
        
        <x-filament-panels::form.actions 
            :actions="[
                \Filament\Actions\Action::make('filter')
                    ->label('Filter')
                    ->submit('filter')
            ]"
        />
    </x-filament-panels::form>
    
    <x-filament::section>
        {{ $this->table }}
    </x-filament::section>
</x-filament-panels::page>