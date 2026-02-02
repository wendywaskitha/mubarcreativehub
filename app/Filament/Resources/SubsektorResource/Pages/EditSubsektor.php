<?php

namespace App\Filament\Resources\SubsektorResource\Pages;

use App\Filament\Resources\SubsektorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubsektor extends EditRecord
{
    protected static string $resource = SubsektorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
