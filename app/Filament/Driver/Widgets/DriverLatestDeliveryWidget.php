<?php

namespace App\Filament\Driver\Widgets;

use Filament\Tables;
use App\Models\Delivery;
use App\Models\DeliveryRegister;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class DriverLatestDeliveryWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                // ...
                DeliveryRegister::query()->where('user_id', Auth::user()->id)->latest()
            )
            ->columns([
                // ...
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle.name')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('vehicle_temprature')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_temprature')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('delivery_temprature')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_in')
                    ->dateTime()
                    ->copyable()
                    ->sortable(),
                TextColumn::make('time_out')
                    ->placeholder('Not filled!')
                    ->dateTime()
                    ->copyable()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('delivery_time')
                //     ->copyable()
                //     ->dateTime()
                //     ->placeholder('Not filled!')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('hours_worked')
                    ->placeholder('Not available!')
                    ->copyable()
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\IconColumn::make('closed_status')
                //     ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
