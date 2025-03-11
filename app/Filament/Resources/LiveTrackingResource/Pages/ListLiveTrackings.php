<?php

namespace App\Filament\Resources\LiveTrackingResource\Pages;

use App\Filament\Resources\LiveTrackingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLiveTrackings extends ListRecords
{
    protected static string $resource = LiveTrackingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
