<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Vehicle;
use App\Models\Delivery;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DeliveryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DeliveryResource\RelationManagers;

class DeliveryResource extends Resource
{
    protected static ?string $model = Delivery::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Motion';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')->schema([
                    Forms\Components\TextInput::make('tracking_number')
                        ->maxLength(255)
                        ->default(null),
                    Select::make('vehicle_id')
                        ->required()
                        ->label('Vehicle')
                        ->options(Vehicle::all()->pluck('name', 'id')),
                    Select::make('driver_id')
                        ->required()
                        ->label('Driver')
                        ->options(User::where('role', 'driver')->pluck('name', 'id')),
                    Forms\Components\TextInput::make('sender_name')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('sender_phone')
                        ->tel()
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('pickup_address')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('dropoff_address')
                        ->maxLength(255)
                        ->default(null),
                    Select::make('status')
                        ->required()
                        ->options([
                            'pending' => 'Pending',
                            'delivered' => 'Delivered',
                            'in progress' => 'In Progress',

                        ])
                        ->default('Pending'),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tracking_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vehicle_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('driver_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sender_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sender_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pickup_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dropoff_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListDeliveries::route('/'),
            'create' => Pages\CreateDelivery::route('/create'),
            'edit' => Pages\EditDelivery::route('/{record}/edit'),
        ];
    }
}
