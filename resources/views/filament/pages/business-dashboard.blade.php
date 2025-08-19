<x-filament-panels::page>
    <x-filament-widgets::widgets
        :columns="[1, 2, 2, 2]"
        :widgets="$this->getHeaderWidgets()"
    />

    <x-filament-widgets::widgets
        :columns="[1, 1, 2]"
        :widgets="$this->getWidgets()"
    />
</x-filament-panels::page>