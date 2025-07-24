<?php

namespace App\Filament\Resources\ArticleEksternalResource\Pages;

use App\Filament\Resources\ArticleEksternalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArticleEksternal extends EditRecord
{
    protected static string $resource = ArticleEksternalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
