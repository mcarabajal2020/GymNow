<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class MonthlyRevenueChart extends ChartWidget
{
    protected ?string $heading = 'Ingresos mensuales';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $gymId = auth()->user()->gym_id;

        $data = Payment::query()
            ->select(
                DB::raw('strftime("%m", payment_date) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->where('gym_id', $gymId)
            ->where('status', 'completed')
            ->whereYear('payment_date', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $months = [
            '01','02','03','04','05','06',
            '07','08','09','10','11','12'
        ];

        $labels = [
            'Ene','Feb','Mar','Abr','May','Jun',
            'Jul','Ago','Sep','Oct','Nov','Dic'
        ];

        $values = [];

        foreach ($months as $month) {
            $values[] = $data[$month] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Ingresos',
                    'data' => $values,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
