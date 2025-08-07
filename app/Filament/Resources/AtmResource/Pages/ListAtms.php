<?php

namespace App\Filament\Resources\AtmResource\Pages;

use App\Filament\Resources\AtmResource;
use App\Imports\AtmsImport;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;

class ListAtms extends ListRecords
{
    protected static string $resource = AtmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('import')
                ->label('Import CSV/Excel')
                ->form([
                    FileUpload::make('attachment')
                        ->label('File CSV/Excel')
                        ->disk('public') // <- Memberitahu untuk simpan di disk 'public'
                        ->required()
                        ->acceptedFileTypes(['text/csv', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                ])
                ->action(function (array $data) {
                    // Ambil objek file yang diunggah
                    $file = $data['attachment'];

                    // Dapatkan path asli dari file sementara
                    $filePath = Storage::disk('public')->path($file);

                    // Lakukan proses impor
                    Excel::import(new AtmsImport, $filePath);

                    // HAPUS FILE SETELAH SELESAI
                    Storage::disk('public')->delete($file);

                    // Tampilkan notifikasi sukses
                    Notification::make()
                        ->title('Impor Data Berhasil')
                        ->body('Data status ATM telah berhasil diperbarui.')
                        ->success()
                        ->send();
                }),

            Actions\CreateAction::make(),
        ];
    }
}
