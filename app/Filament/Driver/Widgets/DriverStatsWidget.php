<?php

namespace App\Filament\Driver\Widgets;

use App\Models\Delivery;
use App\Models\DeliveryRegister;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;



class DriverStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Total Deliveries', DeliveryRegister::where('user_id', Auth::user()->id)->count()),
            Stat::make('Pending Deliveries', DeliveryRegister::where('user_id', Auth::user()->id)->whereNull('time_out')->count()),
            Stat::make('Delivered Deliveries', DeliveryRegister::where('user_id', Auth::user()->id)->whereNotNull('time_out')->count()),
        ];
    }
}
