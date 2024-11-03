<?php

namespace App\Filament\Resources\ProjectResource\Pages\Components;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Livewire\Component;

class PreviewProject extends Component implements HasForms, HasActions, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithActions;
    use InteractsWithInfolists;

    public $record;

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Split::make([
                    Section::make([
                        TextEntry::make('title')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->weight('bold')
                            ->columnSpanFull(),

                        TextEntry::make('description')
                            ->columnSpanFull(),

                        TextEntry::make('technologies')
                            ->badge()
                            ->color('info')
                            ->columnSpanFull(),

                        Split::make([
                            TextEntry::make('live_url')
                                ->label('Live Site')
                                ->url(fn($state) => $state)
                                ->openUrlInNewTab()
                                ->visible(fn($state) => filled($state)),

                            TextEntry::make('github_url')
                                ->label('Source Code')
                                ->url(fn($state) => $state)
                                ->openUrlInNewTab()
                                ->visible(fn($state) => filled($state)),
                        ])->from('md'),
                    ])->grow(),

                    ImageEntry::make('featured_image')
                        ->columnSpanFull()
                        ->visible(fn($state) => filled($state)),
                ])->from('lg'),

                Section::make('Project Overview')
                    ->description(fn($record) => $record->content)
                    ->columnSpanFull(),

                Section::make('Key Features')
                    ->schema([
                        RepeatableEntry::make('features')
                            ->schema([
                                TextEntry::make('title')
                                    ->weight('medium'),
                                TextEntry::make('description'),
                            ])
                            ->columns(1),
                    ])
                    ->columnSpanFull()
                    ->visible(fn($record) => filled($record->features)),

                Section::make('Screenshots')
                    ->schema([
                        Split::make([
                            ImageEntry::make('screenshots')
                                ->columnSpanFull()
                                ->grid(2),
                        ]),
                    ])
                    ->columnSpanFull()
                    ->visible(fn($record) => filled($record->screenshots)),

                Section::make('Technical Details')
                    ->schema([
                        TextEntry::make('technical_details')
                            ->listWithBullets()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->visible(fn($record) => filled($record->technical_details)),
            ]);
    }

    public function render()
    {
        return view('filament.resources.project-resource.components.preview');
    }
}