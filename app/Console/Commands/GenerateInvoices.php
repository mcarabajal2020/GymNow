<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member;
use App\Models\Invoice;
use Carbon\Carbon;

class GenerateInvoices extends Command
{
    protected $signature = 'invoices:generate';

    protected $description = 'Genera facturas automáticas mensuales según billing_day';

    public function handle(): int
    {
        $today = Carbon::today();

        $this->info("Generando facturas para el día {$today->day}...");

       $members = \App\Models\Member::where('status', 'active')
    ->whereNotNull('plan_id')
    ->get();

        foreach ($members as $member) {

            // Seguridad: si no tiene plan asignado, lo salteamos
            if (!$member->plan) {
                $this->warn("Miembro {$member->id} sin plan. Saltando...");
                continue;
            }

            $periodStart = $today->copy();
            $periodEnd = $today->copy()->addMonth()->subDay();

            // Evitar duplicados
            $exists = Invoice::where('member_id', $member->id)
                ->whereDate('period_start', $periodStart)
                ->exists();

            if ($exists) {
                $this->line("Factura ya existente para miembro {$member->id}");
                continue;
            }

            Invoice::create([
                'gym_id' => $member->gym_id,
                'member_id' => $member->id,
                'plan_id' => $member->plan_id,
                'period_start' => $periodStart,
                'period_end' => $periodEnd,
                'due_date' => $periodStart,
                'amount' => $member->plan->price,
                'status' => 'pending',
            ]);

            $this->info("Factura creada para miembro {$member->id}");
        }

        $this->info('Proceso finalizado.');

        return Command::SUCCESS;
    }
}
