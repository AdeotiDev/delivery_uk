<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DriverResource\Pages;
use App\Filament\Resources\DriverResource\RelationManagers;
use App\Models\User;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DriverResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $modelLabel = "Staff";
    protected static ?string $slug = "staff";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->email()
                        ->unique('users', 'email', ignoreRecord: true)
                        ->required()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->tel()
                        ->unique('users', 'phone', ignoreRecord: true)
                        ->required()
                        ->maxLength(255),
                    TextInput::make('password')
                        ->password()
                        ->required()
                        ->revealable()
                        ->maxLength(255),
                    Select::make('role')
                        ->required()
                        ->options([
                            'admin' => 'Admin',
                            'staff' => 'Staff',
                            'driver' => 'Driver',
                        ]),
                ])->columns(2),


                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(User::query()->latest())
            ->columns([
                //
                TextColumn::make('name'),
                TextColumn::make('email')->copyable(),
                TextColumn::make('role')
                    ->badge()->color(fn(string $state): string => match ($state) {
                        'driver' => 'gray',
                        'admin' => 'info',
                        'staff' => 'success',
                    }),
                TextColumn::make('phone')->placeholder('N/A'),
                TextColumn::make('created_at')
                    ->dateTime(),
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
            'index' => Pages\ListDrivers::route('/'),
            'create' => Pages\CreateDriver::route('/create'),
            'edit' => Pages\EditDriver::route('/{record}/edit'),
        ];
    }
}
