<?php

namespace App\Filament\Pages\Analytics;

use Filament\Pages\Page;
use BezhanSalleh\FilamentGoogleAnalytics\Widgets;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.pages.analytics.dashboard';

    protected static ?string $navigationGroup = 'Analytics';

    protected static ?int $navigationSort = 9;

    public static function getNavigationLabel(): string
    {
        return 'Analytics Dashboard';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            Widgets\PageViewsWidget::class,
            Widgets\VisitorsWidget::class,
            Widgets\ActiveUsersOneDayWidget::class,
            Widgets\SessionsWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            Widgets\SessionsByCountryWidget::class,
            Widgets\SessionsByDeviceWidget::class,
            Widgets\SessionsDurationWidget::class,
            Widgets\MostVisitedPagesWidget::class,
            Widgets\TopReferrersListWidget::class,
        ];
    }
}