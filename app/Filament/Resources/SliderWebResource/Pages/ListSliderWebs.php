<?php

namespace App\Filament\Resources\SliderWebResource\Pages;

use App\Filament\Resources\SliderWebResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSliderWebs extends ListRecords
{
    protected static string $resource = SliderWebResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
