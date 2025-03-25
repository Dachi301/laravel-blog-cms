<?php

namespace App\Filament\Resources;

use App\Enums\ArticleStatusEnum;
use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\Pages\EditArticle;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Str;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        TextInput::make('title')
                            ->live(onBlur: true)
                            ->required()
                            ->afterStateUpdated(
                                function (string $operation, $state, callable $set)
                                {
                                    $set('slug', Str::slug($state));
                                }
                            ),
                        TextInput::make('slug')
                            ->required(),
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->label(__('Category'))
                            ->preload()
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set)
                            {
                                $set('sub_category_id', null); // Reset category when department changes
                            }),
                        Select::make('sub_category_id')
                            ->relationship(
                                name: 'sub_category',
                                titleAttribute: 'name',
                                modifyQueryUsing: function (Builder $query, callable $get)
                                {
                                    $categoryId = $get('category_id');
                                    if ($categoryId)
                                    {
                                        $query->where('category_id', $categoryId); // Filter categories based on department
                                    }
                                }
                            )
                            ->label(__('Sub Category'))
                            ->preload()
                            ->searchable()
                            ->required()
                    ]),
                SpatieMediaLibraryFileUpload::make('avatar')->image(),
                RichEditor::make('description')
                        ->required()
                        ->toolbarButtons([
                            'blockquote',
                            'bold',
                            'bulletList',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                            'table'
                        ])
                        ->columnSpan(2),
                    Select::make('status')
                        ->options(ArticleStatusEnum::labels())
                        ->default(ArticleStatusEnum::DRAFT->value)
                        ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                SpatieMediaLibraryImageColumn::make('avatar')
//                    ->collection('images')
//                    ->limit(1)
//                    ->label('Image')
//                    ->conversion('thumb'),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('avatar'),
                TextColumn::make('title')
                    ->sortable()
                    ->words(10)
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors(ArticleStatusEnum::colors()),
                TextColumn::make('category.name'),
                TextColumn::make('sub_category.name'),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(ArticleStatusEnum::labels()),
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
                EditArticle::class,
            ]);
    }
}
