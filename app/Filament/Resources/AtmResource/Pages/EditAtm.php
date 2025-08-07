<?php

namespace App\Filament\Resources\AtmResource\Pages;

use App\Filament\Resources\AtmResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAtm extends EditRecord
{
    protected static string $resource = AtmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
