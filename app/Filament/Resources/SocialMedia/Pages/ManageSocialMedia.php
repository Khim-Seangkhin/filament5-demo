<?php

namespace App\Filament\Resources\SocialMedia\Pages;

use App\Filament\Resources\SocialMedia\SocialMediaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSocialMedia extends ManageRecords
{
    protected static string $resource = SocialMediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
