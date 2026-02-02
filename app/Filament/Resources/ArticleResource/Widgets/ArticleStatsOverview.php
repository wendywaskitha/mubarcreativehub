<?php

namespace App\Filament\Resources\ArticleResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Article;

class ArticleStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalArticles = Article::count();
        $totalViews = Article::sum('views');
        $publishedCount = Article::where('status', 'published')->count();

        return [
            Stat::make('Jumlah Artikel', number_format($totalArticles))
                ->description('Total artikel yang tersedia')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('primary'),

            Stat::make('Total Views', number_format($totalViews))
                ->description('Jumlah kunjungan keseluruhan')
                ->descriptionIcon('heroicon-m-eye')
                ->color('success'),

            Stat::make('Artikel Aktif', number_format($publishedCount))
                ->description('Artikel yang telah dipublikasikan')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('info'),
        ];
    }
}
