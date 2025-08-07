<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;
use App\Filament\Widgets\WelcomeWidget;
use App\Filament\Widgets\AtmOverviewWidget;
use App\Filament\Widgets\TransactionChart;

class Dashboard extends BasePage
{
    public function getWidgets(): array
    {
        return [
            WelcomeWidget::class,
            AtmOverviewWidget::class,
            TransactionChart::class,
        ];
    }
}
