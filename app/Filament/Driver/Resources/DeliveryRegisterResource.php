<?php

namespace App\Filament\Driver\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Vehicle;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\DeliveryRegister;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Driver\Resources\DeliveryRegisterResource\Pages;
use App\Filament\Driver\Resources\DeliveryRegisterResource\Pages\TimeOutForm;
use App\Filament\Driver\Resources\DeliveryRegisterResource\RelationManagers;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;

class DeliveryRegisterResource extends Resource
{
    protected static ?string $model = DeliveryRegister::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';
    protected static ?string $modelLabel = 'Register Delivery ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')->schema([
                    Hidden::make('user_id')->default(Auth::user()->id),
                    Select::make('vehicle_id')
                        ->label('Vehicle')
                        ->required()
                        ->options(Vehicle::get()->pluck('name', 'id')),
                    Forms\Components\DateTimePicker::make('time_in')
                        ->date()
                        ->required(),
                    // Forms\Components\DateTimePicker::make('time_out'),
                    // Forms\Components\DateTimePicker::make('delivery_time'),

                    Forms\Components\Textarea::make('extra_note')
                        ->columnSpanFull(),

                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                DeliveryRegister::query()->where('user_id', Auth::user()->id)
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_in')
                    ->dateTime()
                    ->copyable()
                    ->sortable(),
                TextColumn::make('time_out')
                    ->placeholder('Not filled!')
                    ->dateTime()
                    ->copyable()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('delivery_time')
                //     ->copyable()
                //     ->dateTime()
                //     ->placeholder('Not filled!')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('hours_worked')
                    ->placeholder('Not available!')
                    ->copyable()
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\IconColumn::make('closed_status')
                //     ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->button()
                    ->visible(function ($record) {
                        return is_null($record->time_out);
                    }),


                // A button that links to the Timeout page

                Action::make('Time Out')
                    ->label('Time Out')
                    ->button()
                    ->icon('heroicon-o-clock')
                    ->color('success')
                    ->url(fn($record) => self::getUrl('timeout', ['record' => $record]))
                    ->visible(function ($record) {
                        return is_null($record->time_out);
                    })



            ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ])
        ;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeliveryRegisters::route('/'),
            'create' => Pages\CreateDeliveryRegister::route('/create'),
            'edit' => Pages\EditDeliveryRegister::route('/{record}/edit'),
            'manage' => Pages\TimeOutForm::route('/{record}/manage'),
            'timeout' => Pages\TimeoutPage::route('/{record}/timeout'),
        ];
    }
}
