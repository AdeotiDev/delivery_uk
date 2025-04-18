<?php

namespace App\Filament\Driver\Resources\DeliveryRegisterResource\Pages;

use Carbon\Carbon;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Driver\Resources\DeliveryRegisterResource;

class TimeoutPage extends EditRecord
{
    protected static string $resource = DeliveryRegisterResource::class;
    protected static ?string $title = "Record Timeout";

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')->schema([
                    DateTimePicker::make('time_out')
                        ->label('Time Out')
                        ->required()
                        ->date(),
                ])
            ]);
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Access the current record's time_in
        $timeIn = Carbon::parse($this->record->time_in);
        $timeOut = Carbon::parse($data['time_out']);

        // Calculate hours worked
        $hoursWorked = $timeIn->diffInMinutes($timeOut) / 60;

        // Inject into data array
        $data['hours_worked'] = round($hoursWorked, 2);

        return $data;
    }
}
