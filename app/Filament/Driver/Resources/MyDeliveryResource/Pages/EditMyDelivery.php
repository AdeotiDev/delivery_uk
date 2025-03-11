<?php

namespace App\Filament\Driver\Resources\MyDeliveryResource\Pages;

use App\Filament\Driver\Resources\MyDeliveryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyDelivery extends EditRecord
{
    protected static string $resource = MyDeliveryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
