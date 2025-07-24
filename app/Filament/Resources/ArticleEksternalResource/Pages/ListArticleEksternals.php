<?php

namespace App\Filament\Resources\ArticleEksternalResource\Pages;

use App\Filament\Resources\ArticleEksternalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArticleEksternals extends ListRecords
{
    protected static string $resource = ArticleEksternalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
