<?php

namespace App\Filament\Resources\Interns\Widgets;

use App\Models\User;
use Filament\Support\Icons\Heroicon;
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
            Stat::make('Saran', $suggestionIntern . ' - ' . $totalDataSuggestion . ' Saran')
                ->description('Alumni Magang dengan jumlah Saran terbanyak')
                ->descriptionIcon(Heroicon::LightBulb)
                ->color('primary'),
            Stat::make('Proyek', $projectIntern . ' - ' . $totalDataProject . ' Proyek')
                ->description('Alumni Magang dengan jumlah Proyek terbanyak')
                ->descriptionIcon(Heroicon::BookOpen)
                ->color('primary'),
            Stat::make('Total Data', $totalData)
                ->description('Jumlah total data yang terdaftar')
                ->descriptionIcon(Heroicon::Calculator)
                ->color('primary'),
        ];
    }
}
