<?php

namespace App\Filament\Resources\LiveTrackingResource\Pages;

use App\Filament\Resources\LiveTrackingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLiveTracking extends EditRecord
{
    protected static string $resource = LiveTrackingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
