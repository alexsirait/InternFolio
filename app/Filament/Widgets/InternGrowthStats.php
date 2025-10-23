<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InternGrowthStats extends StatsOverviewWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        // Hitung total pengguna bulan ini
        $currentMonthUsers = User::whereBetween('created_at', [$startDate, $endDate])
            ->where('is_admin', 0)
            ->count();

        // Hitung total pengguna bulan sebelumnya
        $previousMonthStartDate = $startDate->copy()->subMonth();
        $previousMonthEndDate = $endDate->copy()->subMonth();
        $previousMonthUsers = User::whereBetween('created_at', [$previousMonthStartDate, $previousMonthEndDate])
            ->where('is_admin', 0)
            ->count();

        // Hitung kenaikan pengguna
        $growth = $currentMonthUsers - $previousMonthUsers;
        $growthPercentage = $previousMonthUsers > 0 ? ($growth / $previousMonthUsers) * 100 : 0;

        // Hitung total pengguna
        $totalUsers = User::where('is_admin', 0)->count();

        return [
            Stat::make('Total Alumni Magang Bulan Ini', $currentMonthUsers)
                ->description('Jumlah Alumni Magang yang terdaftar bulan ini')
                ->descriptionIcon(Heroicon::UserPlus)
                ->color('primary'),

            Stat::make('Kenaikan Alumni Magang', $growth)
                ->description($previousMonthUsers == 0 && $currentMonthUsers > 0
                    ? '100% (pertumbuhan dari 0 Alumni Magang)'
                    : sprintf('%s%% dari bulan sebelumnya', number_format($growthPercentage)))
                ->descriptionIcon($growth >= 0 ? Heroicon::ArrowTrendingUp : Heroicon::ArrowTrendingDown)
                ->color($growth >= 0 ? 'primary' : 'danger'),

            Stat::make('Total Alumni Magang', $totalUsers)
                ->description('Jumlah total Alumni Magang yang terdaftar')
                ->descriptionIcon(Heroicon::User)
                ->color('primary'),
        ];
    }
}
