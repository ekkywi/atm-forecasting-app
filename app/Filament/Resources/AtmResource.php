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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;

class AtmResource extends Resource
{
    protected static ?string $model = Atm::class;

    protected static ?string $navigationGroup = 'Manajemen ATM';

    protected static ?string $navigationLabel = 'Master Data ATM';
    protected static ?string $pluralModelLabel = 'Master Data ATM';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Mesin')
                    ->schema([
                        TextInput::make('terminal_id')
                            ->label('Terminal ID')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Select::make('type')
                            ->options([
                                'ATM' => 'ATM (Tarik Tunai)',
                                'CRM' => 'CRM (Setor Tarik)',
                            ])->required()->native(false),
                        Select::make('status')
                            ->options([
                                'active' => 'Aktif',
                                'inactive' => 'Tidak Aktif',
                                'maintenance' => 'Dalam Perbaikan',
                            ])->required()->native(false),
                    ])->columns(3),

                Section::make('Informasi Lokasi')
                    ->schema([
                        TextInput::make('location_name')
                            ->label('Nama Lokasi')
                            ->required(),
                        Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->columnSpanFull(),
                        TextInput::make('latitude')->numeric(),
                        TextInput::make('longitude')->numeric(),
                    ])->columns(2),

                Section::make('Detail Cassette Uang')
                    ->schema([
                        Repeater::make('cassettes')
                            ->relationship()
                            ->schema([
                                TextInput::make('cassette_index')
                                    ->label('Nomor Kaset')
                                    ->numeric()->required()->minValue(1)->maxValue(4),
                                Select::make('denomination')
                                    ->label('Denominasi')
                                    ->options(['50000' => 'Rp 50.000', '100000' => 'Rp 100.000'])
                                    ->required()->native(false),
                                TextInput::make('max_sheets')
                                    ->label('Pagu Lembar')
                                    ->numeric()->required()->default(2000),
                            ])
                            ->columns(3)
                            ->addActionLabel('Tambah Cassette'),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('terminal_id')
                    ->label('Terminal ID')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location_name')
                    ->label('Nama Lokasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe Mesin')
                    ->badge(), // Menampilkan sebagai badge
                Tables\Columns\TextColumn::make('status')
                    ->badge() // Menampilkan sebagai badge
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'maintenance' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('created_at')
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
