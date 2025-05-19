<?php

namespace App\Filament\Driver\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Vehicle;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\DeliveryRoute;
use App\Models\DeliveryRegister;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Driver\Resources\DeliveryRegisterResource\Pages;
use App\Filament\Driver\Resources\DeliveryRegisterResource\RelationManagers;
use App\Filament\Driver\Resources\DeliveryRegisterResource\Pages\TimeOutForm;

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
                    TextInput::make('vehicle_temprature')
                        ->required(),

                    TextInput::make('product_temprature')
                        ->required(),
                    TextInput::make('delivery_temprature')
                        ->required(),
                    Forms\Components\DateTimePicker::make('time_in')
                        ->date()
                        ->required(),
                    Forms\Components\DateTimePicker::make('take_off_time')
                        ->date()
                        ->required(),
                    Select::make('delivery_route_id')
                        ->label('Delivery Route')
                        ->required()
                        ->options(DeliveryRoute::get()->pluck('route_name', 'id'))
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('extra_note')
                        ->columnSpanFull(),

                ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                DeliveryRegister::query()->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('delivery_route.route_name')
                    ->placeholder('N/A')
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle_temprature')
                    ->placeholder('N/A')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product_temprature')
                    ->placeholder('N/A')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('delivery_temprature')
                    ->placeholder('N/A')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_in')
                    ->dateTime()
                    ->copyable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('take_off_time')
                    ->dateTime()
                    ->placeholder('N/A')
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
