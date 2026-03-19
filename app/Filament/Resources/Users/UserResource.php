<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\ManageUsers;
use App\Models\User;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
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
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use UnitEnum;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Users;
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
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->readOnlyOn('edit'),
                        TextInput::make('phone')
                            ->tel(),
                        TextInput::make('password')
                            ->revealable()
                            ->confirmed()
                            ->password()
                            ->required()
                            ->visibleOn('create'),
                        TextInput::make('password_confirmation')
                            ->revealable()
                            ->password()
                            ->required()
                            ->label('Confirm Password')
                            ->visibleOn('create'),
                        Select::make('role')
                            ->options([
                                'ADMIN' => 'ADMIN',
                                'USER' => 'USER',
                                'EDITOR' => 'EDITOR',
                                'GUEST' => 'GUEST',
                            ])
                            ->default('USER'),
                    ])->columnSpan(2),
                Section::make()
                    ->schema([
                        FileUpload::make('avatar')
                            ->directory('avatar'),
                        Toggle::make('status')
                            ->default(true),
                    ])->columnSpan(1),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                // TextColumn::make('email')
                //     ->searchable(),
                TextInputColumn::make('email')
                    ->rules(['required', 'max:255']),
                TextColumn::make('phone')
                    ->default('--')
                    ->searchable(),
                ImageColumn::make('avatar')
                    ->default(asset('img/default-user.jpg'))
                    ->imageHeight(40)
                    ->circular(),
                TextColumn::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ADMIN' => 'danger',
                        'EDITOR' => 'primary',
                        'USER' => 'success',
                        default => 'secondary',
                    })
                    ->searchable(),
                IconColumn::make('status')
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
            'index' => ManageUsers::route('/'),
        ];
    }
}
