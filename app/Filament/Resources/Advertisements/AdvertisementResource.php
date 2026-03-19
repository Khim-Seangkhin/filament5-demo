<?php

namespace App\Filament\Resources\Advertisements;

use App\Enums\Position;
use App\Filament\Resources\Advertisements\Pages\ManageAdvertisements;
use App\Models\Advertisement;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class AdvertisementResource extends Resource
{
    protected static ?string $model = Advertisement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Megaphone;
    protected static string | UnitEnum | null $navigationGroup = 'News';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->maxLength(255),
                        TextInput::make('url')
                            ->url()
                            ->nullable(),
                        Select::make('position')
                            ->options([
                                'popup' => 'Popup',
                                'header' => 'Header',
                                'body' => 'Body'
                            ])
                            ->required(),
                        DateTimePicker::make('start_date'),
                        DateTimePicker::make('end_date'),
                        TextInput::make('priority')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])->columnSpan(2),
                Section::make()
                    ->schema([
                        FileUpload::make('photo')
                            ->image()
                            ->directory('ads')
                            ->required(),
                        Toggle::make('is_active')
                            ->default(true),
                    ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->limit(30)
                    ->searchable(),
                ImageColumn::make('photo'),
                TextColumn::make('url')
                    ->limit(30),
                TextColumn::make('position'),
                TextColumn::make('start_date')
                    ->date(),
                TextColumn::make('end_date')
                    ->date(),
                TextColumn::make('priority'),
                TextColumn::make('views')
                    ->numeric(),
                TextColumn::make('clicks')
                    ->numeric(),
                IconColumn::make('is_active')
                    ->boolean(),
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
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ])
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
            'index' => ManageAdvertisements::route('/'),
        ];
    }
}
