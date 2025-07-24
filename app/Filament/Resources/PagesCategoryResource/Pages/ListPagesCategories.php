<?php

namespace App\Filament\Resources\PagesCategoryResource\Pages;

use App\Filament\Resources\PagesCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPagesCategories extends ListRecords
{
    protected static string $resource = PagesCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
