<?php

namespace App\Filament\Driver\Resources\DeliveryRegisterResource\Pages;

use App\Filament\Driver\Resources\DeliveryRegisterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeliveryRegister extends EditRecord
{
    protected static string $resource = DeliveryRegisterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
