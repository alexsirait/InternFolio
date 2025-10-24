<?php

namespace App\Filament\Intern\Resources\Suggestions\Widgets;

use App\Models\Category;
use App\Models\Suggestion;
use Filament\Support\Icons\Heroicon;
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
                ->descriptionIcon(Heroicon::ArrowTrendingUp)
                ->color('primary'),
            Stat::make('Kategori Favorite', $popularCategory . ' - ' . $totalDataPopuler . ' Saran')
                ->description('Kategori dengan jumlah Saran terbanyak')
                ->descriptionIcon(Heroicon::LightBulb)
                ->color('primary'),
            Stat::make('Total Saran', $totalsuggestions)
                ->description('Jumlah total Saran yang terdaftar')
                ->descriptionIcon(Heroicon::Calculator)
                ->color('primary'),
        ];
    }
}
