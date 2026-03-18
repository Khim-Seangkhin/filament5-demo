<?php

namespace App\Filament\Resources\SocialMedia;

use App\Filament\Resources\SocialMedia\Pages\ManageSocialMedia;
use App\Models\SocialMedia;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class SocialMediaResource extends Resource
{
    protected static ?string $model = SocialMedia::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::GlobeAlt;
    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('platform')
                    ->required(),
                TextInput::make('icon'),
                TextInput::make('url')
                    ->url()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('platform')
                    ->searchable(),
                TextColumn::make('icon')
                    ->searchable(),
                TextColumn::make('url')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSocialMedia::route('/'),
        ];
    }
}
