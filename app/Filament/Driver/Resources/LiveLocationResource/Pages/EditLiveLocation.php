<?php

namespace App\Filament\Driver\Resources\LiveLocationResource\Pages;

use App\Filament\Driver\Resources\LiveLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLiveLocation extends EditRecord
{
    protected static string $resource = LiveLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
