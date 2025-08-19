<?php

namespace App\Filament\Resources\PurchaseOrderOutResource\Pages;

use App\Filament\Resources\PurchaseOrderOutResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPurchaseOrderOuts extends ListRecords
{
    protected static string $resource = PurchaseOrderOutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
