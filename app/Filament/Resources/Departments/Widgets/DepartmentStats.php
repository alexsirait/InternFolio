<?php

namespace App\Filament\Resources\Departments\Widgets;

use App\Models\Department;
use Filament\Support\Icons\Heroicon;
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
            Stat::make('Alumni Magang', $popularDepartment . ' - ' . $totalDataPopular . ' Alumni Magang')
                ->description('Departemen dengan jumlah Alumni Magang terbanyak')
                ->descriptionIcon(Heroicon::AcademicCap)
                ->color('primary'),
            Stat::make('Proyek', $projectDepartment . ' - ' . $totalDataProject . ' Proyek')
                ->description('Departemen dengan jumlah Proyek terbanyak')
                ->descriptionIcon(Heroicon::BookOpen)
                ->color('primary'),
            Stat::make('Total Data', $totalData)
                ->description('Jumlah total data yang terdaftar')
                ->descriptionIcon(Heroicon::Calculator)
                ->color('primary'),
        ];
    }
}
