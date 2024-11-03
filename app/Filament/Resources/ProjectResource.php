<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $navigationLabel = 'Projects';

    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $state, Forms\Set $set) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\TextInput::make('description')
                            ->required()
                            ->maxLength(500),

                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('featured_image')
                            ->image()
                            ->directory('projects/featured')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Links')
                    ->schema([
                        Forms\Components\TextInput::make('live_url')
                            ->label('Live Site URL')
                            ->url()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('github_url')
                            ->label('GitHub Repository URL')
                            ->url()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Technologies')
                    ->schema([
                        Forms\Components\TagsInput::make('technologies')
                            ->separator(',')
                            ->suggestions([
                                'Laravel',
                                'Vue.js',
                                'React',
                                'Tailwind CSS',
                                'MySQL',
                                'PostgreSQL',
                                'Redis',
                                'AWS',
                            ]),
                    ]),

                Forms\Components\Section::make('Features')
                    ->schema([
                        Forms\Components\Repeater::make('features')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('description')
                                    ->required()
                                    ->maxLength(500),
                            ])
                            ->columnSpanFull()
                            ->defaultItems(1)
                            ->collapsible(),
                    ]),

                Forms\Components\Section::make('Screenshots')
                    ->schema([
                        Forms\Components\FileUpload::make('screenshots')
                            ->multiple()
                            ->image()
                            ->directory('projects/screenshots')
                            ->maxFiles(6)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Technical Details')
                    ->schema([
                        Forms\Components\TagsInput::make('technical_details')
                            ->separator(',')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->square()
                    ->size(80),
                    
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->searchable(),
                    
                Tables\Columns\TagsColumn::make('technologies')
                    ->separator(',')
                    ->limit(3),
                    
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
                Tables\Filters\SelectFilter::make('technologies')
                    ->multiple()
                    ->options(fn () => Project::pluck('technologies')
                        ->flatten()
                        ->unique()
                        ->sort()),
            ])
            ->actions([
                Tables\Actions\Action::make('preview')
                    ->modalContent(fn (Project $record) => view(
                        'livewire.page.project.detail',
                        ['project' => $record, 'nextProject' => $record->getNextProject()]
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->modalWidth('7xl'),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
