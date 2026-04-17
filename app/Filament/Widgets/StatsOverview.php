<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\Product;
use App\Models\Inquiry;
use App\Models\Article;
use Carbon\Carbon;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::count())
                ->description('Katalog produk di database')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('success'),
                
            Stat::make('Total Inkuiri', Inquiry::count())
                ->description('Seluruh prospek masuk')
                ->descriptionIcon('heroicon-m-chat-bubble-bottom-center-text')
                ->color('primary'),

            Stat::make('Total Artikel', Article::count())
                ->description('Publikasi di website')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),
                
            Stat::make('Inkuiri Hari Ini', Inquiry::whereDate('created_at', Carbon::today())->count())
                ->description('Prospek masuk hari ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),
        ];
    }
}
