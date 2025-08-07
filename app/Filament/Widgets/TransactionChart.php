<?php

namespace App\Filament\Widgets;

use App\Models\AtmStatus;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TransactionChart extends ChartWidget
{
    protected static ?string $heading = 'Laporan Transaksi per Hari (7 Hari Terakhir)';
    protected static ?int $sort = 2; // Urutan widget di dashboard

    protected function getData(): array
    {
        $data = AtmStatus::select(DB::raw('DATE(reported_at) as date'), DB::raw('count(*) as count'))
            ->where('reported_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Laporan',
                    'data' => $data->pluck('count'),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->pluck('date'),
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Tipe grafik: line, bar, pie, etc.
    }
}
