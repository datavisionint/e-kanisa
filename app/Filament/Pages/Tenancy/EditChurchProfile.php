<?php

namespace App\Filament\Pages\Tenancy;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Pages\Tenancy\EditTenantProfile;

class EditChurchProfile extends  EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Church Profile';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name'),
                    ]),
            ]);
    }
}
