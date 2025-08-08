<?php

namespace App\Filament\Widgets;

use App\Models\AtmStatus;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TransactionChart extends ChartWidget
{
    protected static ?string $heading = 'Laporan Transaksi per Hari (7 Hari Terakhir)';
    protected static ?int $sort = 2; // Urutan widget di dashboard

    protected function getType(): string
    {
        return 'line'; // Tipe grafik: line, bar, pie, etc.
    }
}
