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
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;;

class AtmResource extends Resource
{
    protected static ?string $model = Atm::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Mesin')
                    ->description('Detail identitas dan status mesin ATM.')
                    ->schema([
                        TextInput::make('atm_id')
                            ->label('ID ATM')
                            ->required()
                            ->unique(ignoreRecord: true) // Harus unik, kecuali untuk record yg sedang diedit
                            ->maxLength(255),
                        Select::make('status')
                            ->options([
                                'active' => 'Aktif',
                                'inactive' => 'Tidak Aktif',
                                'maintenance' => 'Dalam Perbaikan',
                            ])
                            ->native(false) // Agar tampilan dropdown lebih modern
                            ->required(),
                    ])->columns(2), // Membagi section ini menjadi 2 kolom

                Section::make('Informasi Lokasi')
                    ->schema([
                        TextInput::make('location_name')
                            ->label('Nama Lokasi')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->columnSpanFull(), // Membuat field ini memakan lebar penuh
                        TextInput::make('latitude')
                            ->numeric(),
                        TextInput::make('longitude')
                            ->numeric(),
                    ])->columns(2),

                Section::make('Informasi Kapasitas Cassette')
                    ->description('Kapasitas maksimal dalam jumlah lembar.')
                    ->schema([
                        TextInput::make('max_capacity_100k')
                            ->label('Kapasitas 100 Ribu')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        TextInput::make('max_capacity_50k')
                            ->label('Kapasitas 50 Ribu')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ])->columns(2),
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
