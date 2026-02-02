<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\StatsOverviewWidget;
use App\Filament\Widgets\UMKMChartWidget;
use App\Filament\Widgets\UMKMBySubsectorChart;
use App\Filament\Widgets\UMKMByBusinessTypeChart;
use App\Filament\Widgets\UMKMGrowthChart;
use App\Filament\Widgets\TopUMKMEmployeesChart;
use App\Filament\Widgets\UMKMHakiStatusChart;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public function getColumns(): int
    {
        return 2;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverviewWidget::class,
        ];
    }

    public function getWidgets(): array
    {
        return [
            UMKMChartWidget::class,
            UMKMBySubsectorChart::class,
            UMKMByBusinessTypeChart::class,
            UMKMGrowthChart::class,
            // TopUMKMEmployeesChart::class,
            // UMKMHakiStatusChart::class,

            // Google Analytics Widgets
            Widgets\PageViewsWidget::class,
            Widgets\VisitorsWidget::class,
            Widgets\ActiveUsersOneDayWidget::class,
            Widgets\SessionsWidget::class,
            Widgets\SessionsByCountryWidget::class,
            Widgets\MostVisitedPagesWidget::class,
        ];
    }

}
