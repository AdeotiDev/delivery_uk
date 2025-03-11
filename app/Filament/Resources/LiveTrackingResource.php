<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LiveTrackingResource\Pages;
use App\Filament\Resources\LiveTrackingResource\RelationManagers;
use App\Models\LiveTracking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LiveTrackingResource extends Resource
{
    protected static ?string $model = LiveTracking::class;


    public static function getNavigationBadge(): ?string
    {
        return "unavailable";
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return 'info';
    }
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Motion';

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
            'index' => Pages\ListLiveTrackings::route('/'),
            'create' => Pages\CreateLiveTracking::route('/create'),
            'edit' => Pages\EditLiveTracking::route('/{record}/edit'),
        ];
    }
}
