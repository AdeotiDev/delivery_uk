<?php

namespace App\Filament\Resources\LiveTrackingResource\Pages;

use App\Filament\Resources\LiveTrackingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLiveTracking extends CreateRecord
{
    protected static string $resource = LiveTrackingResource::class;
    protected static bool $canCreateAnother = false;
}
