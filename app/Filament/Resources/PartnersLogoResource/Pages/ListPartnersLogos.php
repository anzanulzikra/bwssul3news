<?php

namespace App\Filament\Resources\PartnersLogoResource\Pages;

use App\Filament\Resources\PartnersLogoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPartnersLogos extends ListRecords
{
    protected static string $resource = PartnersLogoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}