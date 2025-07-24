<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Filament\Resources\ArticleResource\RelationManagers\ArticleImagesRelationManager;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Article';

    protected static ?string $navigationLabel = 'Berita';
    protected static ?string $pluralLabel = 'Data Berita';
    protected static ?string $label = 'Berita';
    protected static ?string $slug = 'berita';
    protected static ?int $navigationSort = 0;

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
                                            $set('slug',\Str::slug($state));
                                        }
                                    }),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\RichEditor::make('content')
                                    ->label('Content')
                                    ->required()
                                    ->columnSpanFull(),
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
                                                                   Forms\Components\Select::make('tags')
                                    ->label('Tags')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->allowHtml()
                                    ->getSearchResultsUsing(function (string $search): array {
                                        $tags = Tag::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray();
                                        
                                        if (empty($tags) && !empty($search)) {
                                            // Auto-create tag if not found
                                            $newTag = Tag::create(['name' => $search]);
                                            $tags[$newTag->id] = $newTag->name;
                                        }
                                        
                                        return $tags;
                                    }),
                                Forms\Components\DateTimePicker::make('published_at')
                                    ->default(function ($record) {
                                        return $record ? null : now();
                                    })
                                    ->disabled(function ($record) {
                                        // Disabled hanya saat create
                                        return $record === null;
                                    })
                                    ->dehydrated(), // Pastikan nilai tetap tersimpan meski disabled
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
                
               
                // SECTION: Article Images Management
                Forms\Components\Section::make('Gambar lainnya')
                    ->description('Kelola gambar-gambar untuk Berita ini. Anda dapat menambahkan multiple gambar dengan caption.')
                    ->icon('heroicon-o-photo')
                    ->collapsible()
                   // ->collapsed() 
                    ->schema([
                     
                        // REPEATER: Article Images
                        Forms\Components\Repeater::make('images')
                            ->label('') // Kosong karena sudah ada label di Section
                            ->relationship('images') // Otomatis handle create/update/delete
                            ->schema([
                                // Grid layout untuk organize fields dalam repeater item
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        // Field untuk upload gambar
                                        Forms\Components\FileUpload::make('image_path')
                                            ->label('Image')
                                            ->image() // Restrict ke image files saja
                                            ->imageEditor() // Enable built-in image editor
                                            ->imagePreviewHeight('150') // Preview height
                                            ->maxSize(2048) // Max 2MB
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                            ->required()
                                            ->columnSpan(1),
                                        
                                        // Field untuk caption gambar
                                        Forms\Components\TextInput::make('caption')
                                            ->label('Caption')
                                            ->placeholder('Tuliskan caption untuk gambar...')
                                            ->maxLength(255)
                                            ->columnSpan(1),
                                    ]),
                            ])
                            ->reorderable() // Enable drag & drop reordering
                            ->collapsible() // Setiap item bisa di-collapse
                            ->cloneable() // Enable clone functionality
                            ->itemLabel(function (array $state): ?string {
                                // Custom label untuk setiap item berdasarkan caption
                                return $state['caption'] ?? 'Image #' . (array_search($state, request()->input('images', [])) + 1);
                            })
                            ->addActionLabel('+ Tambah Gambar')
                            ->defaultItems(0) // Start dengan 0 items
                            ->minItems(0) // Minimum 0 items
                            ->maxItems(10) // Maximum 10 images
                            ->deleteAction(
                                fn ($action) => $action
                                    ->requiresConfirmation()
                                    ->modalHeading('Hapus Gambar')
                                    ->modalDescription('Apakah Anda yakin ingin menghapus gambar ini?')
                                    ->modalSubmitActionLabel('Ya, Hapus')
                            )
                            ->reorderAction(
                                fn ($action) => $action->label('Reorder')
                            )
                            ->columnSpanFull(), // Full width dalam section
                    ])
                    ->columnSpanFull(), // Section mengambil full width
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
          
                Tables\Columns\TextColumn::make('title')
                ->label("Judul")  
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make
                ('featured_image')
                ->label("Gambar")  ,
                Tables\Columns\TextColumn::make('published_at')
                ->label("Publish")  
                    ->date()
                    ->limit(12)
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
           // ArticleImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
