<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AtmResource\Pages;
use App\Filament\Resources\AtmResource\RelationManagers;
use App\Models\Atm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AtmResource extends Resource
{
    protected static ?string $model = Atm::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('atm_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('location_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('latitude')
                    ->numeric(),
                Forms\Components\TextInput::make('longitude')
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('active'),
                Forms\Components\TextInput::make('max_capacity_100k')
                    ->numeric(),
                Forms\Components\TextInput::make('max_capacity_50k')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('atm_id')
                    ->searchable() // Membuat kolom ini bisa dicari
                    ->sortable(),  // Membuat kolom ini bisa diurutkan
                Tables\Columns\TextColumn::make('location_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge() // Menampilkan status sebagai "badge" berwarna
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'maintenance' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Kolom ini bisa disembunyikan
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
            'index' => Pages\ListAtms::route('/'),
            'create' => Pages\CreateAtm::route('/create'),
            'edit' => Pages\EditAtm::route('/{record}/edit'),
        ];
    }
}
