<?php

namespace App\Filament\Resources\PartnersLogoResource\Pages;

use App\Filament\Resources\PartnersLogoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPartnersLogo extends EditRecord
{
    protected static string $resource = PartnersLogoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
