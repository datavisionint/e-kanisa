<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChurchMemberResource\Pages;
use App\Models\ChurchMember;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ChurchMemberResource extends Resource
{
    protected static ?string $model = ChurchMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make()
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->placeholder("John"),
                        Forms\Components\TextInput::make('middle_name')
                            ->placeholder("James"),
                        Forms\Components\TextInput::make('last_name')
                            ->placeholder("Selemani")
                            ->required(),
                        Forms\Components\Radio::make('gender')
                            ->default("male")
                            ->options([
                                "male" => "Male",
                                "female" => "Female"
                            ]),
                        Forms\Components\DatePicker::make('birth_date'),
                        Forms\Components\TextInput::make('phone_number')
                            ->prefix("255")
                            ->placeholder("751778899"),
                        Hidden::make("status")
                            ->default("active")
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->prefix("255")
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageChurchMembers::route('/'),
        ];
    }
}
