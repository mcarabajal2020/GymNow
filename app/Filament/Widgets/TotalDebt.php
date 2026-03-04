<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Invoice;

class TotalDebt extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalDebt = Invoice::where('gym_id', auth()->user()->gym_id)
            ->whereIn('status', ['pending', 'overdue'])
            ->sum('amount');

        return [
            Stat::make('Deuda total', '$ ' . number_format($totalDebt, 2, ',', '.'))
                ->description('Facturas pendientes y vencidas')
                ->color('danger'),
        ];
    }
}
