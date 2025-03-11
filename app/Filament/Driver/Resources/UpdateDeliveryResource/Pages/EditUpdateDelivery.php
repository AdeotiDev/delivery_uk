<?php

namespace App\Filament\Driver\Resources\UpdateDeliveryResource\Pages;

use App\Filament\Driver\Resources\UpdateDeliveryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUpdateDelivery extends EditRecord
{
    protected static string $resource = UpdateDeliveryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
