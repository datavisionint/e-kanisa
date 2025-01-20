<?php

namespace App\Filament\Resources\ChurchMemberResource\Pages;

use App\Filament\Resources\ChurchMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageChurchMembers extends ManageRecords
{
    protected static string $resource = ChurchMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
