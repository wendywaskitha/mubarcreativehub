<?php

namespace App\Filament\Resources\UMKMResource\Pages;

use App\Filament\Resources\UMKMResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUMKM extends ViewRecord
{
    protected static string $resource = UMKMResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
