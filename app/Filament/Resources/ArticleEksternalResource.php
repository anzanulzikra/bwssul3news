<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleEksternalResource\Pages;
use App\Filament\Resources\ArticleEksternalResource\RelationManagers;
use App\Models\ArticleEksternal;
use App\Models\Category;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleEksternalResource extends Resource
{
    protected static ?string $model = ArticleEksternal::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Berita Eksternal';
    protected static ?string $pluralLabel = 'Berita Eksternal';
    protected static ?string $label = 'Berita Eksternal';
    protected static ?string $slug = 'berita-eksternal';
    protected static ?string $navigationGroup = 'Article';

    protected static ?int $navigationSort = 21;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        // Left Section (70% - spans 2 columns)
                        Forms\Components\Section::make('Article Content')
                            ->columnSpan(2)
                            ->schema([
                                  Forms\Components\Select::make('author_id')
                                    ->label('Author')
                                    ->options(User::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->default(auth()->id())
                                    ->required(),
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, $set) {
                                        if ($state) {
                                            $set('slug', \Str::slug($state));
                                        }
                                    }),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('link')
                                    ->label('External Link')
                                    ->required()
                                    ->maxLength(255)
                                    ->url(),
                            ]),
                        
                        // Right Section (30% - spans 1 column)
                        Forms\Components\Section::make('Informasi')
                            ->columnSpan(1)
                            ->schema([
                                Forms\Components\Select::make('category_id')
                                    ->label('Category')
                                    ->options(Category::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->default(function ($record) {
                                        return $record ? null : now();
                                    })
                                    ->disabled(function ($record) {
                                        // Disabled hanya saat create
                                        return $record === null;
                                    })
                                    ->dehydrated(),
                                Forms\Components\Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                    ])
                                    ->default('published')
                                    ->required(),
                                Forms\Components\Toggle::make('is_favorite')
                                    ->label('Is Favorite'),
                                Forms\Components\FileUpload::make('featured_image')
                                    ->label('Featured Image')
                                    ->image(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->limit(50)
                    ->searchable(),
           
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                     Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('featured_image'),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'info',
                        default => 'gray',
                    }),
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
                Tables\Actions\ActionGroup::make([
                    
                  
                    Tables\Actions\DeleteAction::make(),
                ])
                ->icon('heroicon-m-ellipsis-vertical')
                ->tooltip('Actions')
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
            'index' => Pages\ListArticleEksternals::route('/'),
            'create' => Pages\CreateArticleEksternal::route('/create'),
            'edit' => Pages\EditArticleEksternal::route('/{record}/edit'),
        ];
    }
}
