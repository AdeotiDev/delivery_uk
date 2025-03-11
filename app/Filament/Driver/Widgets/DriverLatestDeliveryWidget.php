<?php

namespace App\Filament\Driver\Widgets;

use Filament\Tables;
use App\Models\Delivery;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class DriverLatestDeliveryWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                // ...
                Delivery::query()->where('driver_id', auth()->user()->id)->latest()
            )
            ->columns([
                // ...
                TextColumn::make('tracking_number'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'gray',
                        'Pending' => 'gray',
                        'delivered' => 'success',
                        'in progress' => 'warning',
                    }),
                TextColumn::make('created_at')
                    ->dateTime(),
            ]);
    }
}
