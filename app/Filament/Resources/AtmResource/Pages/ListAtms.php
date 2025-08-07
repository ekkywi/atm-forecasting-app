<?php

namespace App\Filament\Resources\AtmResource\Pages;

use App\Filament\Resources\AtmResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAtms extends ListRecords
{
    protected static string $resource = AtmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
