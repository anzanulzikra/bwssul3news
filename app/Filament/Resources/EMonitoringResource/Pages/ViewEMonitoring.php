<?php

namespace App\Filament\Resources\EMonitoringResource\Pages;

use App\Filament\Resources\EMonitoringResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEMonitoring extends ViewRecord
{
    protected static string $resource = EMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
