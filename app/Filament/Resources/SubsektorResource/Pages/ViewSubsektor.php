<?php

namespace App\Filament\Resources\SubsektorResource\Pages;

use App\Filament\Resources\SubsektorResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSubsektor extends ViewRecord
{
    protected static string $resource = SubsektorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
