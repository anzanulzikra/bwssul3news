<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderWebResource\Pages;
use App\Filament\Resources\SliderWebResource\RelationManagers;
use App\Models\SliderWeb;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SliderWebResource extends Resource
{
    protected static ?string $model = SliderWeb::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationLabel = 'Slider Web';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?int $navigationSort = 50;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('slider')
                    ->required(),
                Forms\Components\TextInput::make('link_url')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
  ,
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0)
                                        ->default(function () {
                        return SliderWeb::max('order') + 1;
                    })
                    ->disabled()
                    ->dehydrated(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('link_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->reorderable('order')
            ->defaultSort('order')
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSliderWebs::route('/'),
           // 'create' => Pages\CreateSliderWeb::route('/create'),
           // 'edit' => Pages\EditSliderWeb::route('/{record}/edit'),
        ];
    }
}
