<?php

namespace App\Filament\Widgets;

use App\Models\Delivery;
use App\Models\DeliveryRegister;
use App\Models\User;
use App\Models\Vehicle;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AppStat extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Drivers', User::where('role', 'driver')->count())
                ->color('primary')
                ->icon('heroicon-s-users'),
            Stat::make('Vehicles', Vehicle::count())
                ->color('primary')
                ->icon('heroicon-s-users'),
            Stat::make('Pending Deliveries', DeliveryRegister::whereNull('time_out')->count())
                ->color('primary')
                ->icon('heroicon-s-users'),

        ];
    }
}
