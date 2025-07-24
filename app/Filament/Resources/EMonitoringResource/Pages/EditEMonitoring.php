<?php

namespace App\Filament\Resources\EMonitoringResource\Pages;

use App\Filament\Resources\EMonitoringResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEMonitoring extends EditRecord
{
    protected static string $resource = EMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
