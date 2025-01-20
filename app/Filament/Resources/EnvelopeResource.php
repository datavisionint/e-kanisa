<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnvelopeResource\Pages;
use App\Filament\Resources\EnvelopeResource\RelationManagers;
use App\Models\Envelope;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
                Forms\Components\Select::make('member_id')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->first_name} {$record->last_name}")
                    ->relationship('member', 'full_name'),
                Forms\Components\Select::make('offering_type_id')
                    ->required()
                    ->relationship('offeringType', 'name'),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->prefix("TZS")
                    ->mask(moneyMask()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordClasses(fn(Model $record) => "envelope")
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->prefix('#')
                    ->searchable(),
                Tables\Columns\TextColumn::make('member.full_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('offeringType.name')
                    ->sortable()
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('member.phone_number')
                    ->sortable()
                    ->prefix('255')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
