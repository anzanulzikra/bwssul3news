<?php

namespace App\Filament\Resources\ArticleResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;

class ArticleImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $recordTitleAttribute = 'caption';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image_path')
                    ->label('Image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('caption')
                    ->label('Caption')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('caption')
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->size(100),
                Tables\Columns\TextColumn::make('caption')
                    ->label('Caption')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Action::make('uploadMultiple')
                    ->label('Upload Multiple Images')
                    ->form([
                        Forms\Components\FileUpload::make('images')
                            ->label('Images')
                            ->image()
                            ->multiple()
                            ->required(),
                        Forms\Components\TextInput::make('caption')
                            ->label('Caption (applies to all images)')
                            ->maxLength(255),
                    ])
                    ->action(function (array $data): void {
                        $images = $data['images'];
                        $caption = $data['caption'] ?? '';
                        
                        foreach ($images as $image) {
                            $this->getOwnerRecord()->images()->create([
                                'image_path' => $image,
                                'caption' => $caption,
                            ]);
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
} 