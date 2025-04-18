<?php

namespace App\Filament\Driver\Resources\DeliveryRegisterResource\Pages;

use App\Filament\Driver\Resources\DeliveryRegisterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDeliveryRegisters extends ListRecords
{
    protected static string $resource = DeliveryRegisterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Register Delivery'),
        ];
    }
}
