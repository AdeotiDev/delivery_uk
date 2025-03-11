<?php

namespace App\Filament\Widgets;

use App\Models\Delivery;
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
                Delivery::query()
            )
            ->columns([
                // ...
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
                TextColumn::make('created_at'),
            ]);
    }
}
