<?php

namespace App\Filament\Resources\AtmResource\Pages;

use App\Filament\Resources\AtmResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAtm extends CreateRecord
{
    protected static string $resource = AtmResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
