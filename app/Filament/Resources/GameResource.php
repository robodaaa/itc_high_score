<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameResource\Pages;
use App\Filament\Resources\GameResource\RelationManagers;
use App\Models\Game;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;
    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Beállítások';

    public static function getModelLabel(): string {
        return __('messages.game');
    }

    public static function getPluralModelLabel(): string {
        return __('messages.games');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('messages.name'))
                                    ->autofocus()
                                    ->required()
                                    ->live(onBlur:true)
                                    ->afterStateUpdated(function(string $operation, $state, Forms\Set $set) {
                                        if($operation !== 'create') {
                                            return;
                                        }
                                        $set('slug', Str::slug($state));
                                    }),
                                TextInput::make('slug')
                                    ->label(Lang::get('messages.slug'))
                                    ->disabled()
                                    ->required()
                                    ->dehydrated()
                                    ->unique(Game::class, 'slug', ignoreRecord: true),
                            ])
                            ->columns(2),
                    ]),
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Toggle::make('is_active')
                                    ->label(Lang::get('messages.is_active'))
                                    ->default(true),
                                DateTimePicker::make('created_at')
                                    ->label(Lang::get('messages.created_at'))
                                    ->disabled(),
                                DateTimePicker::make('updated_at')
                                    ->label(Lang::get('messages.updated_at'))
                                    ->disabled(),
                            ]),
                        ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(Lang::get('messages.name'))
                    ->sortable()
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label(Lang::get('messages.is_active'))
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label(Lang::get('messages.created_at'))
                    ->since()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('updated_at')
                    ->label(Lang::get('messages.updated_at'))
                    ->since()
                    ->sortable()
                    ->toggleable()
            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->label(Lang::get('messages.is_active'))
                    ->options([
                        '1' => Lang::get('messages.yes'),
                        '0' => Lang::get('messages.no'),
                    ])
                    ->default('1'),
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
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }
}
