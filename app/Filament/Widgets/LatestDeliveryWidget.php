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
                DeliveryRegister::query()->latest()
            )
            ->columns([
                // ...

                TextColumn::make('user.name')->label('Driver'),
                TextColumn::make('vehicle.name')->label('Vehicle'),
                TextColumn::make('delivery_route.route_name')
                    ->placeholder('N/A')
                    ->sortable(),
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
                TextColumn::make('time_in')->dateTime(),
                TextColumn::make('take_off_time')->dateTime()->placeholder('Not filled!'),
                TextColumn::make('time_out')->dateTime()->placeholder('Not filled!'),
                TextColumn::make('hours_worked')->placeholder('Not available!')
                    ->badge(),
                TextColumn::make('created_at')->dateTime(),
            ]);
    }
}
