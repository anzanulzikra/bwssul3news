<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EMonitoringResource\Pages;
use App\Filament\Resources\EMonitoringResource\RelationManagers;
use App\Models\EMonitoring;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EMonitoringResource extends Resource
{
    protected static ?string $model = EMonitoring::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?string $navigationLabel = 'E-Monitoring';
    protected static ?string $pluralLabel = 'E-Monitoring';
    protected static ?string $label = 'E-Monitoring';
    protected static ?string $slug = 'e-monitoring';

    protected static ?string $navigationGroup = 'Halaman';

    protected static ?int $navigationSort = 33;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('satuan_kerja')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('realisasi_fisik')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('last_updated')
                    ->required(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('satuan_kerja')
                    ->searchable(),
                Tables\Columns\TextColumn::make('realisasi_fisik')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_updated')
                    ->dateTime()
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
            ->filters([
                //
            ])
            ->actions([
               // Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListEMonitorings::route('/'),
            //'create' => Pages\CreateEMonitoring::route('/create'),
            //'view' => Pages\ViewEMonitoring::route('/{record}'),
            //'edit' => Pages\EditEMonitoring::route('/{record}/edit'),
        ];
    }
}
