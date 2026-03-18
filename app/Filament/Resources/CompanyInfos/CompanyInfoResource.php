<?php

namespace App\Filament\Resources\CompanyInfos;

use App\Filament\Resources\CompanyInfos\Pages\ManageCompanyInfos;
use App\Models\CompanyInfo;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use League\Csv\Query\Limit;
use UnitEnum;

class CompanyInfoResource extends Resource
{
    protected static ?string $model = CompanyInfo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice;
        protected static string | UnitEnum | null $navigationGroup = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([

                        TextInput::make('company_name')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('address')
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email(),
                        TextInput::make('phone')
                            ->maxLength(15)
                            ->tel(),
                        Textarea::make('description')
                            ->columnSpanFull(),
                        TextInput::make('privacy_policy_url'),
                        TextInput::make('copyright_text'),
                            // ->url(),
                    ])->columnSpan(2),
                Section::make()
                    ->schema([
                        FileUpload::make('logo')
                            ->image()
                            ->directory('logo')
                            ->required(),
                        FileUpload::make('footer_logo')
                            ->image()
                            ->directory('footer_logo')
                            ->required(),
                    ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company_name')
                    ->searchable(),
                TextColumn::make('address')
                    ->Limit(30)
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('privacy_policy_url')
                    ->Limit(30)
                    ->searchable(),
                TextColumn::make('copyright_text')
                    ->Limit(30)
                    ->searchable(),
                ImageColumn::make('logo')
                    ->searchable(),
                ImageColumn::make('footer_logo')
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
            'index' => ManageCompanyInfos::route('/'),
        ];
    }
}
