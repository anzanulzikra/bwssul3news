<?php

namespace App\Filament\Resources\GalleryResource\RelationManagers;

use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    protected function getListeners(): array
    {
        return [
            'photo-featured-updated' => '$refresh',
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->required()
                    ->multiple()
                    ->image()
                    ->directory('gallery-photos'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('image')
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Photos')
                    ->mutateFormDataUsing(function (array $data): array {
                        $images = $data['image'];
                        unset($data['image']);
                        $data['images'] = $images;
                        return $data;
                    })
                    ->using(function (array $data, string $model): Model {
                        $records = [];
                        foreach ($data['images'] as $image) {
                            $records[] = $model::create(['image' => $image, 'gallery_id' => $this->ownerRecord->id]);
                        }
                        return collect($records)->last();
                    }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}