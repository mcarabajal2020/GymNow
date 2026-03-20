<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class MembersWithDebt extends BaseWidget
{
    protected static ?string $heading = 'Miembros con deuda';

    protected int|string|array $columnSpan = 'full';

   protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
{
    $gymId = auth()->user()->gym_id;

    return \App\Models\Member::query()
        ->where('gym_id', $gymId)
        ->select('members.*')
        ->selectSub(function ($query) {
            $query->from('invoices')
                ->leftJoin('payments', function ($join) {
                    $join->on('payments.invoice_id', '=', 'invoices.id')
                        ->where('payments.status', '=', 'completed');
                })
                ->whereColumn('invoices.member_id', 'members.id')
                ->whereIn('invoices.status', ['pending', 'overdue'])
                ->selectRaw('COALESCE(SUM(invoices.amount - COALESCE(payments.amount,0)),0)');
        }, 'debt')
        ->whereRaw('
            (
                select COALESCE(SUM(invoices.amount - COALESCE(payments.amount,0)),0)
                from invoices
                left join payments
                    on payments.invoice_id = invoices.id
                    and payments.status = "completed"
                where invoices.member_id = members.id
                and invoices.status in ("pending","overdue")
            ) > 0
        ')
        ->orderByDesc('debt');
}

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('full_name')
                ->label('Miembro')
                ->searchable(),

            Tables\Columns\TextColumn::make('phone')
                ->label('Teléfono'),

            Tables\Columns\TextColumn::make('debt')
        ->label('Deuda')
        ->money('ARS')
        ->color('danger'),
        ];
    }
}

