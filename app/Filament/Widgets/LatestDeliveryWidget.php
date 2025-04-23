<?php

namespace App\Filament\Widgets;

use App\Models\Delivery;
use App\Models\DeliveryRegister;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;


class LatestDeliveryWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                DeliveryRegister::query()
            )
            ->columns([
                // ...

                TextColumn::make('user.name')->label('Driver'),
                TextColumn::make('vehicle.name')->label('Vehicle'),
                Tables\Columns\TextColumn::make('vehicle_temprature')
                    ->toggleable()
                    ->placeholder('N/A')
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_temprature')
                    ->toggleable()
                    ->placeholder('N/A')
                    ->sortable(),
                Tables\Columns\TextColumn::make('delivery_temprature')
                    ->toggleable()
                    ->placeholder('N/A')
                    ->sortable(),
                TextColumn::make('time_in')->date(),
                TextColumn::make('time_out')->date()->placeholder('Not filled!'),
                TextColumn::make('hours_worked')->placeholder('Not available!')
                    ->badge(),
                TextColumn::make('created_at'),
            ]);
    }
}
