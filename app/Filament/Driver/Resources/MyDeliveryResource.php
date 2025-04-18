<?php

namespace App\Filament\Driver\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Delivery;
use Filament\Forms\Form;
use App\Models\MyDelivery;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Driver\Resources\MyDeliveryResource\Pages;
use App\Filament\Driver\Resources\MyDeliveryResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

use function Laravel\Prompts\warning;

class MyDeliveryResource extends Resource
{
    protected static ?string $model = Delivery::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'History';
    protected static ?string $modelLabel = 'My Deliveries';
    protected static bool $isDiscovered = false;





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
            ->query(Delivery::query()->where('driver_id', auth()->user()->id)->latest())
            ->columns([
                //
                TextColumn::make('tracking_number')
                    ->searchable(),
                TextColumn::make('sender_name')
                    ->searchable(),
                TextColumn::make('sender_phone'),
                TextColumn::make('pickup_address')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('dropoff_address')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'gray',
                        'Pending' => 'gray',
                        'delivered' => 'success',
                        'in progress' => 'warning',
                    }),
                TextColumn::make('created_at'),
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
            'index' => Pages\ListMyDeliveries::route('/'),
            'create' => Pages\CreateMyDelivery::route('/create'),
            'edit' => Pages\EditMyDelivery::route('/{record}/edit'),
        ];
    }
}
