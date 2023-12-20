<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoundResource\Pages;
use App\Filament\Resources\RoundResource\RelationManagers;
use App\Models\Game;
use App\Models\Round;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoundResource extends Resource
{
    protected static ?string $model = Round::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string {
        return __('messages.round');
    }

    public static function getPluralModelLabel(): string {
        return __('messages.rounds');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                ->schema([
                    Section::make()
                    ->schema([
                        Select::make('game_id')
                            ->label(__('messages.game'))
                            ->placeholder(__('messages.select_game'))
                            ->options(
                                Game::all()->pluck('name', 'id')->toArray()
                            )
                            ->required(),
                        Repeater::make('points')
                            ->label(__('messages.points'))
                            ->relationship()
                            ->orderColumn('sort')
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->schema([
                                Select::make('user_id')
                                    ->label(__('messages.user'))
                                    ->placeholder(__('messages.select_user'))
                                    ->options(
                                        User::all()->pluck('name', 'id')->toArray()
                                    )
                                    ->required(),
                                TextInput::make('points')
                                    ->label(__('messages.point'))
                                    ->integer()
                                    ->required(),
                                Toggle::make('is_active')
                                    ->label(__('messages.is_active'))
                                    ->default(true)
                                    ->required(),
                            ]),
                    ]),
                ]),
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                DateTimePicker::make('created_at')
                                    ->label(__('messages.created_at'))
                                    ->disabled(),
                                DateTimePicker::make('updated_at')
                                    ->label(__('messages.updated_at'))
                                    ->disabled(),
                                Toggle::make('is_active')
                                    ->label(__('messages.is_active'))
                                    ->default(true)
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('game.name')
                    ->label(__('messages.game'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('messages.created_at'))
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label(__('messages.updated_at'))
                    ->sortable(),
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
            'index' => Pages\ListRounds::route('/'),
            'create' => Pages\CreateRound::route('/create'),
            'edit' => Pages\EditRound::route('/{record}/edit'),
        ];
    }
}
