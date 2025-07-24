<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublikasiResource\Pages;
use App\Filament\Resources\PublikasiResource\RelationManagers;
use App\Models\Publikasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PublikasiResource extends Resource
{
    protected static ?string $model = Publikasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Lainnya';

    protected static ?string $navigationGroup = 'Publikasi';

    protected static ?int $navigationSort = 41;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->options([
                        'video' => 'Video',
                        'infografis' => 'Infografis / Pengumuman',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('link_url')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                ->directory('partners-logo')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                // Tables\Columns\TextColumn::make('link_url')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPublikasis::route('/'),
           // 'create' => Pages\CreatePublikasi::route('/create'),
          //  'edit' => Pages\EditPublikasi::route('/{record}/edit'),
        ];
    }
}
