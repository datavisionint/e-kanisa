<?php

namespace App\Filament\Resources\OfferingTypeResource\Pages;

use App\Filament\Resources\OfferingTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOfferingTypes extends ManageRecords
{
    protected static string $resource = OfferingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
