<?php

namespace App\Filament\Resources\PurchaseOrderOutResource\Pages;

use App\Filament\Resources\PurchaseOrderOutResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurchaseOrderOut extends EditRecord
{
    protected static string $resource = PurchaseOrderOutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
