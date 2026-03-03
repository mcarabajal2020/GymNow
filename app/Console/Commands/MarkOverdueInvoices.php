<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use Carbon\Carbon;

class MarkOverdueInvoices extends Command
{
    protected $signature = 'invoices:mark-overdue';

    protected $description = 'Marca como vencidas las facturas pendientes cuya fecha de vencimiento ya pasó';

    public function handle()
    {
        $count = Invoice::where('status', 'pending')
            ->whereDate('due_date', '<', Carbon::today())
            ->update([
                'status' => 'overdue'
            ]);

        $this->info("Facturas vencidas actualizadas: {$count}");
    }
}
