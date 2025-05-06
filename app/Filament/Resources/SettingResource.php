<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Controls';


    public static function canCreate(): bool
    {
        if (Setting::count() > 0) {
            return false;
        }
        return true;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->schema([
                        Forms\Components\TextInput::make('app_name')
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('app_email')
                            ->email()
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('app_phone')
                            ->tel()
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('app_address')
                            ->maxLength(255)
                            ->default(null),

                        Forms\Components\TextInput::make('app_currency')
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('app_currency_symbol')
                            ->maxLength(255)
                            ->default(null),
                        Select::make('app_currency_position')
                            ->options([
                                'before' => 'Before',
                                'after' => 'After',
                            ])
                            ->default('after'),
                        Forms\Components\TextInput::make('app_timezone')
                            ->maxLength(255)
                            ->default(null),


                        Section::make('media')->schema([
                            FileUpload::make('app_logo')
                                ->uploadingMessage('Uploading App Logo')
                                ->default(null),
                            FileUpload::make('app_favicon')
                                ->default(null),



                            Section::make('Carousel')
                                ->schema(
                                    [
                                        FileUpload::make('carousels')
                                            ->label('Upload carousel images')
                                            ->multiple()
                                            ->uploadingMessage('Uploading carousels...'),
                                    ]
                                )
                        ])->columns(2)
                    ])->columns(4)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('app_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('app_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('app_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('app_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('app_logo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('app_favicon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('app_currency')
                    ->searchable(),
                Tables\Columns\TextColumn::make('app_currency_symbol')
                    ->searchable(),
                Tables\Columns\TextColumn::make('app_currency_position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('app_timezone')
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
