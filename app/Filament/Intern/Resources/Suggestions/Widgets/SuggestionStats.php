<?php

namespace App\Filament\Intern\Resources\Suggestions\Widgets;

use App\Models\Category;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SuggestionStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $userId = Auth::id();

        // Hitung total suggestion
        $totalsuggestions = Suggestion::where('user_id', $userId)->count();

        // Get data populer
        $mostPopularCategory = Category::query()
            ->where('category_type', 'suggestion')
            ->withCount(['suggestions' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->orderByDesc('suggestions_count')
            ->first();

        $popularCategory = $mostPopularCategory->category_name;
        $totalDataPopuler = $mostPopularCategory->suggestions_count;

        // Persentase kontribusi
        $totalUser = Suggestion::where('user_id', $userId)->count();
        $totalAll = Suggestion::count();
        $contribution = $totalAll > 0 ? round(($totalUser / $totalAll) * 100, 2) : 0;

        return [
            Stat::make('Persentase kontribusi', $contribution . '%')
                ->description('Persentase kontribusi terhadap keseluruhan aplikasi')
                ->descriptionIcon('heroicon-s-arrow-trending-up')
                ->color('danger'),
            Stat::make('Kategori Favorite', $popularCategory . ' - ' . $totalDataPopuler . ' suggestion')
                ->description('Kategori dengan jumlah suggestion terbanyak')
                ->descriptionIcon('heroicon-s-chart-pie')
                ->color('info'),
            Stat::make('Total suggestion', $totalsuggestions)
                ->description('Jumlah total suggestion yang terdaftar')
                ->descriptionIcon('heroicon-s-inbox-stack')
                ->color('success'),
        ];
    }
}
