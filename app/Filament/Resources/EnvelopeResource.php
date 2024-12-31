<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnvelopeResource\Pages;
use App\Filament\Resources\EnvelopeResource\RelationManagers;
use App\Models\Envelope;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnvelopeResource extends Resource
{
    protected static ?string $model = Envelope::class;

    protected static ?string $navigationIcon = 'heroicon-s-envelope';

    protected static ?string $recordTitleAttribute  = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Grid::make()
                    ->columns(6)
                    ->schema([
                        Tables\Columns\TextColumn::make('id')
                            ->sortable()
                            ->searchable(),
                    ])
            ])
            ->contentGrid(["sm"=>3])
            ->filters([
                //
            ])
            ->actions([
                // ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                // ])
            ])

            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEnvelopes::route('/'),
        ];
    }
}
