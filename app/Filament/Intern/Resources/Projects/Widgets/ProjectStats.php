<?php

namespace App\Filament\Intern\Resources\Projects\Widgets;

use App\Models\Project;
use App\Models\Category;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProjectStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $userId = Auth::id();

        // Hitung total project
        $totalProjects = Project::where('user_id', $userId)->count();

        // Hitung average project
        $avgDurations = Project::where('user_id', $userId)->avg('project_duration');

        $avgDurations = (int) $avgDurations;

        // Get data populer
        $mostPopularCategory = Category::query()
            ->where('category_type', 'Project')
            ->withCount(['projects' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])
            ->orderByDesc('projects_count')
            ->first();

        $popularCategory = $mostPopularCategory->category_name;
        $totalDataPopuler = $mostPopularCategory->projects_count;

        return [
            Stat::make('Rata-rata durasi', $avgDurations . ' bulan')
                ->description('Rata-rata durasi keseluruhan Proyek')
                ->descriptionIcon(Heroicon::Clock)
                ->color('primary'),
            Stat::make('Kategori Favorite', $popularCategory . ' - ' . $totalDataPopuler . ' Proyek')
                ->description('Kategori dengan jumlah Proyek terbanyak')
                ->descriptionIcon(Heroicon::BookOpen)
                ->color('primary'),
            Stat::make('Total Proyek', $totalProjects)
                ->description('Jumlah total Proyek yang terdaftar')
                ->descriptionIcon(Heroicon::Calculator)
                ->color('primary'),
        ];
    }
}
