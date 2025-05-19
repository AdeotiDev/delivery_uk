<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeliveryRouteResource\Pages;
use App\Filament\Resources\DeliveryRouteResource\RelationManagers;
use App\Models\DeliveryRoute;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeliveryRouteResource extends Resource
{
    protected static ?string $model = DeliveryRoute::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-right-end-on-rectangle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Route Details')->schema([
                    Forms\Components\TextInput::make('route_name')
                        ->maxLength(255)
                        ->default(null),
                    Textarea::make('description')
                        ->maxLength(255)
                        ->default(null),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('route_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListDeliveryRoutes::route('/'),
            'create' => Pages\CreateDeliveryRoute::route('/create'),
            'edit' => Pages\EditDeliveryRoute::route('/{record}/edit'),
        ];
    }
}
