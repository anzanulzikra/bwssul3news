<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalArticlesWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Artikel', Article::count())
                ->description('Semua artikel dalam web')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('warning')
                ->chart([7, 2, 10, 3, 15, 4, 17])
            ,
            
            Stat::make('Artikel Dipublikasi', Article::where('status', 'published')->count())
                ->description('Artikel yang sudah dipublikasi')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([17, 16, 14, 15, 14, 13, 12])
                ,
            
            Stat::make('Artikel Draft', Article::where('status', 'draft')->count())
                ->description('Artikel yang masih dalam draft')
                ->descriptionIcon('heroicon-m-pencil-square')
                ->color('warning')
                ->chart([3, 4, 5, 6, 7, 8, 9])
               ,
        ];
    }
}
