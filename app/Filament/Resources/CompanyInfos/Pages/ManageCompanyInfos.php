<?php

namespace App\Filament\Resources\CompanyInfos\Pages;

use App\Filament\Resources\CompanyInfos\CompanyInfoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCompanyInfos extends ManageRecords
{
    protected static string $resource = CompanyInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
