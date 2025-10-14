<?php

namespace App\Filament\Resources\Categories\Widgets;

use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CategoryStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        // Hitung total kategori
        $totalData = Category::count();

        // Hitung total kategori bulan ini
        $currentMonthData = Category::whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $mostPopularCategory = Category::query()
            ->withCount('projects')
            ->orderByDesc('projects_count')
            ->first();

        $popularCategory = $mostPopularCategory->category_name;
        $totalDataPopuler = $mostPopularCategory->projects_count;

        return [
            Stat::make('Total Data Bulan Ini', $currentMonthData)
                ->description('Jumlah data yang terdaftar bulan ini')
                ->descriptionIcon('heroicon-s-chart-bar-square')
                ->color('danger'),
            Stat::make('Kategori Favorite', $popularCategory . ' - ' . $totalDataPopuler . ' project')
                ->description('Kategori dengan jumlah project terbanyak')
                ->descriptionIcon('heroicon-s-chart-pie')
                ->color('info'),
            Stat::make('Total Data', $totalData)
                ->description('Jumlah total data yang terdaftar')
                ->descriptionIcon('heroicon-s-calculator')
                ->color('success'),
        ];
    }
}
