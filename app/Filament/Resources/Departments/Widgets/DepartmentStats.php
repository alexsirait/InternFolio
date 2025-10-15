<?php

namespace App\Filament\Resources\Departments\Widgets;

use App\Models\Department;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DepartmentStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        // Hitung total department
        $totalData = Department::count();

        $mostPopularDepartment = Department::query()
            ->withCount('users')
            ->orderByDesc('users_count')
            ->first();

        $popularDepartment = $mostPopularDepartment->department_name;
        $totalDataPopular = $mostPopularDepartment->users_count;

        $mostProjectDepartment = Department::query()
            ->withCount('projects')
            ->orderByDesc('projects_count')
            ->first();

        $projectDepartment = $mostProjectDepartment->department_name;
        $totalDataProject = $mostProjectDepartment->projects_count;

        return [
            Stat::make('Intern', $popularDepartment . ' - ' . $totalDataPopular . ' intern')
                ->description('Department dengan jumlah intern terbanyak')
                ->descriptionIcon('heroicon-s-chart-pie')
                ->color('danger'),
            Stat::make('Project', $projectDepartment . ' - ' . $totalDataProject . ' project')
                ->description('Department dengan jumlah project terbanyak')
                ->descriptionIcon('heroicon-s-chart-pie')
                ->color('info'),
            Stat::make('Total Data', $totalData)
                ->description('Jumlah total data yang terdaftar')
                ->descriptionIcon('heroicon-s-calculator')
                ->color('success'),
        ];
    }
}
