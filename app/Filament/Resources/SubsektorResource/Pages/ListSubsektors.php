<?php

namespace App\Filament\Resources\SubsektorResource\Pages;

use App\Filament\Resources\SubsektorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubsektors extends ListRecords
{
    protected static string $resource = SubsektorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
