<?php

namespace App\Filament\Driver\Resources;

use App\Filament\Driver\Resources\UpdateDeliveryResource\Pages;
use App\Filament\Driver\Resources\UpdateDeliveryResource\RelationManagers;
use App\Models\Delivery;
use App\Models\UpdateDelivery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class UpdateDeliveryResource extends Resource
{
    protected static ?string $model = Delivery::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';
    protected static ?string $modelLabel = 'Update Status';

    public static function canCreate(): bool
    {
        return false;
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
            ->query(
                Delivery::query()->where('driver_id', Auth::user()->id)->latest()
            )
            ->columns([
                //
                TextColumn::make('tracking_number'),
                TextColumn::make('sender_name'),
                TextColumn::make('sender_phone'),
                TextColumn::make('pickup_address'),
                TextColumn::make('dropoff_address'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'gray',
                        'Pending' => 'gray',
                        'delivered' => 'success',
                        'in progress' => 'warning',
                    }),
                SelectColumn::make('status')
                    ->options(
                        [
                            'pending' => 'Pending',
                            'delivered' => 'Delivered',
                            'in progress' => 'In Progress',
                        ]
                    )

            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
        ;
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
            'index' => Pages\ListUpdateDeliveries::route('/'),
            'create' => Pages\CreateUpdateDelivery::route('/create'),
            'edit' => Pages\EditUpdateDelivery::route('/{record}/edit'),
        ];
    }
}
