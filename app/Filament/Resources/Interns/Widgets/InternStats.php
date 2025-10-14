<?php

namespace App\Filament\Resources\Interns\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InternStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        // Hitung total intern
        $totalData = User::where('is_admin', 0)->count();

        $mostProjectIntern = User::query()
            ->where('is_admin', 0)
            ->withCount('projects')
            ->orderByDesc('projects_count')
            ->first();

        $projectIntern = $mostProjectIntern->user_name;
        $totalDataProject = $mostProjectIntern->projects_count;

        $mostSuggestionIntern = user::query()
            ->where('is_admin', 0)
            ->withCount('suggestions')
            ->orderByDesc('suggestions_count')
            ->first();

        $suggestionIntern = $mostSuggestionIntern->user_name;
        $totalDataSuggestion = $mostSuggestionIntern->suggestions_count;

        return [
            Stat::make('Suggestion', $suggestionIntern . ' - ' . $totalDataSuggestion . ' suggestion')
                ->description('Intern dengan jumlah suggestion terbanyak')
                ->descriptionIcon('heroicon-s-chart-pie')
                ->color('danger'),
            Stat::make('Project', $projectIntern . ' - ' . $totalDataProject . ' project')
                ->description('Intern dengan jumlah project terbanyak')
                ->descriptionIcon('heroicon-s-chart-pie')
                ->color('info'),
            Stat::make('Total Data', $totalData)
                ->description('Jumlah total data yang terdaftar')
                ->descriptionIcon('heroicon-s-calculator')
                ->color('success'),
        ];
    }
}
