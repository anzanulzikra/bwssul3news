<?php

namespace App\Filament\Resources\SliderWebResource\Pages;

use App\Filament\Resources\SliderWebResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSliderWeb extends EditRecord
{
    protected static string $resource = SliderWebResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
