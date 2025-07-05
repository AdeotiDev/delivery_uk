<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\User;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')->schema([
                    Hidden::make('driver_id')->default(1),
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('plate_number')
                        ->required()
                        ->maxLength(255),
                    Select::make('type')
                        ->options([
                            'Van' => 'Van',
                            'Truck' => 'Truck',
                            'Bus' => 'Bus',
                            'SUV' => 'SUV',
                            'Pickup Truck' => 'Pickup Truck',
                            'Trailer' => 'Trailer',
                            'Motorcycle' => 'Motorcycle',
                            'Sedan' => 'Sedan',
                            'Minivan' => 'Minivan',
                            'Convertible' => 'Convertible',

                        ])
                        ->required()
                        ->default('Van'),
                   
                    Select::make('status')
                        ->options(
                            [
                                'Active' => 'Active',
                                'Inactive' => 'Inactive',
                                'Under Maintenance' => 'Under Maintenance',
                            ]
                        )
                        ->required()
                        ->default('Active'),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plate_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
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
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
