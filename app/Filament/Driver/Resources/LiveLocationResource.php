<?php

namespace App\Filament\Driver\Resources;

use App\Filament\Driver\Resources\LiveLocationResource\Pages;
use App\Filament\Driver\Resources\LiveLocationResource\RelationManagers;
use App\Models\LiveLocation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LiveLocationResource extends Resource
{
    protected static ?string $model = LiveLocation::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'History';


    public static function getNavigationBadge(): ?string
    {
        return "unavailable";
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return 'info';
    }

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
                //
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
            'index' => Pages\ListLiveLocations::route('/'),
            'create' => Pages\CreateLiveLocation::route('/create'),
            'edit' => Pages\EditLiveLocation::route('/{record}/edit'),
        ];
    }
}
