<?php

namespace App\Filament\Driver\Pages;

use App\Filament\Driver\Widgets\DriverLatestDeliveryWidget;
use App\Filament\Driver\Widgets\DriverStatsWidget;
use Filament\Pages\Page;

class CustomDriverDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.driver.pages.custom-driver-dashboard';
    protected static ?string $title = 'Dashboard';
    protected static ?string $slug = 'dashboard';



    protected function getHeaderWidgets(): array
    {
        return [
            DriverStatsWidget::class,
            DriverLatestDeliveryWidget::class,
        ];
    }
}
