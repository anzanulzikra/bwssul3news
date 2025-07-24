<?php

namespace App\Filament\Resources\PagesCategoryResource\Pages;

use App\Filament\Resources\PagesCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPagesCategory extends EditRecord
{
    protected static string $resource = PagesCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
