<?php

namespace App\Filament\Intern\Resources\Projects\Widgets;

use App\Models\Project;
use App\Models\Category;
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
                ->description('Rata-rata durasi keseluruhan project')
                ->descriptionIcon('heroicon-s-globe-alt')
                ->color('danger'),
            Stat::make('Kategori Favorite', $popularCategory . ' - ' . $totalDataPopuler . ' project')
                ->description('Kategori dengan jumlah project terbanyak')
                ->descriptionIcon('heroicon-s-chart-pie')
                ->color('info'),
            Stat::make('Total Project', $totalProjects)
                ->description('Jumlah total project yang terdaftar')
                ->descriptionIcon('heroicon-s-inbox-stack')
                ->color('success'),
        ];
    }
}
