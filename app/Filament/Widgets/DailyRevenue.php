<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Payment;

class DailyRevenue extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $total = Payment::where('gym_id', auth()->user()->gym_id)
            ->where('status', 'completed')
            ->whereDate('payment_date', today())
            ->sum('amount');

        return [
            Stat::make('Cobrado hoy', '$ ' . number_format($total, 2, ',', '.'))
                ->description('Pagos confirmados del día')
                ->color('success'),
        ];
    }
}