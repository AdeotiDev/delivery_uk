<?php

namespace App\Filament\Driver\Resources\UpdateDeliveryResource\Pages;

use App\Filament\Driver\Resources\UpdateDeliveryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUpdateDeliveries extends ListRecords
{
    protected static string $resource = UpdateDeliveryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
