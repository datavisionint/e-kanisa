<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\Offering as ClustersOffering;
use App\Filament\Resources\OfferingResource\Pages;
use App\Filament\Resources\OfferingResource\RelationManagers;
use App\Models\Offering;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfferingResource extends Resource
{
    protected static ?string $model = Offering::class;

    // protected static ?string $navigationIcon = 'heroicon-s-archive-box-arrow-down';

    protected static ?string $cluster = ClustersOffering::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make("Details")
                    ->schema([
                        Forms\Components\Select::make('envelope_id')
                            ->required()
                            ->relationship('envelope', 'id'),
                        Forms\Components\Select::make('offering_type_id')
                            ->required()
                            ->relationship('type', 'name'),
                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->prefix("TZS")
                            ->numeric(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('envelope.id')
                    ->numeric()
                    ->label('Envelope #')
                    ->sortable(),
                Tables\Columns\TextColumn::make('type.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOfferings::route('/'),
            'create' => Pages\CreateOffering::route('/create'),
            'edit' => Pages\EditOffering::route('/{record}/edit'),
        ];
    }
}
