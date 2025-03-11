<?php

namespace App\Filament\Driver\Widgets;

use App\Models\Delivery;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DriverStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Total Deliveries', Delivery::where('driver_id', auth()->user()->id)->count()),
            Stat::make('Pending Deliveries', Delivery::where('driver_id', auth()->user()->id)->where('status', 'pending')->count()),
            Stat::make('Delivered Deliveries', Delivery::where('driver_id', auth()->user()->id)->where('status', 'delivered')->count()),
        ];
    }
}
