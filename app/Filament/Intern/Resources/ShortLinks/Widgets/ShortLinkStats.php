<?php

namespace App\Filament\Intern\Resources\ShortLinks\Widgets;

use App\Models\ShortLink;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class ShortLinkStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $userId = Auth::id();

        // Total shortlinks
        $totalShortLinks = ShortLink::where('user_id', $userId)->count();

        // Total clicks
        $totalClicks = ShortLink::where('user_id', $userId)->sum('clicks');

        // Most clicked shortlink
        $mostClicked = ShortLink::where('user_id', $userId)
            ->orderBy('clicks', 'desc')
            ->first();

        $mostClickedCount = $mostClicked ? $mostClicked->clicks : 0;

        // Average clicks per shortlink
        $averageClicks = $totalShortLinks > 0 ? round($totalClicks / $totalShortLinks, 1) : 0;

        // Recent clicks (last 7 days)
        $recentClicks = ShortLink::where('user_id', $userId)
            ->where('updated_at', '>=', now()->subDays(7))
            ->sum('clicks');

        return [
            Stat::make('Total Short Links', $totalShortLinks)
                ->description('Jumlah short link yang dibuat')
                ->descriptionIcon('heroicon-o-link')
                ->color('primary')
                ->chart([7, 3, 5, 8, 12, 9, $totalShortLinks]),

            Stat::make('Total Klik', $totalClicks)
                ->description('Total seluruh klik')
                ->descriptionIcon('heroicon-o-cursor-arrow-ripple')
                ->color('primary')
                ->chart([20, 35, 50, 75, 90, 120, $totalClicks]),

            Stat::make('Rata-rata Klik', $averageClicks)
                ->description('Per short link')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('primary'),

            Stat::make('Terpopuler', $mostClickedCount . ' klik')
                ->description($mostClicked ? 'Link: ' . $mostClicked->code : 'Belum ada data')
                ->descriptionIcon('heroicon-o-fire')
                ->color('primary'),
        ];
    }

    protected function getColumns(): int
    {
        return 4;
    }
}
