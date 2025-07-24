<?php

namespace App\Filament\Resources\EMonitoringResource\Pages;

use App\Filament\Resources\EMonitoringResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEMonitorings extends ListRecords
{
    protected static string $resource = EMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
