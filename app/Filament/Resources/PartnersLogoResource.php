<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PartnersLogo;
use Filament\Resources\Resource;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PartnersLogoResource\Pages;
use App\Filament\Resources\PartnersLogoResource\RelationManagers;

class PartnersLogoResource extends Resource
{
    protected static ?string $model = PartnersLogo::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?int $navigationSort = 51;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('logo_path')
                    ->directory('partners-logo')
                    ->required(),
                Forms\Components\TextInput::make('website_url')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(function () {
                        return PartnersLogo::max('order') + 1;
                    })
                    ->disabled()
                    ->dehydrated(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('logo_path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website_url')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('order')
                //     ->numeric()
                //     ->sortable(),
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
             //   Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListPartnersLogos::route('/'),
            // Hapus route create dan edit untuk menggunakan modal
            // 'create' => Pages\CreatePartnersLogo::route('/create'),
            // 'edit' => Pages\EditPartnersLogo::route('/{record}/edit'),
        ];
    }
}