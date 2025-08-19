<?php

namespace App\Filament\Resources\FileOrderResource\Pages;

use App\Filament\Resources\FileOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFileOrder extends EditRecord
{
    protected static string $resource = FileOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
