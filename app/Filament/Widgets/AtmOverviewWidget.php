<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Atm;

class AtmOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total ATMs', Atm::count())
                ->description('Jumlah semua mesin terdaftar')
                ->color('success'),

            Stat::make('ATMs Bermasalah', Atm::where('status', '!=', 'active')->count())
                ->description('Mesin butuh perhatian')
                ->color('danger'),

            Stat::make('Total Transaksi (Hari Ini)', \App\Models\AtmStatus::whereDate('reported_at', today())->count())
                ->description('Laporan impor yang masuk hari ini')
                ->color('info'),
        ];
    }
}
