<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AppStat;
use App\Filament\Widgets\LatestDeliveryWidget;
use Filament\Pages\Page;

class CustomAdminDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.custom-admin-dashboard';
    protected static ?string $title = 'Dashboard';
    protected static ?string $slug = 'dashboard';





    protected function getHeaderWidgets(): array
    {
        return [
            AppStat::class,
            LatestDeliveryWidget::class,
        ];
    }
}
