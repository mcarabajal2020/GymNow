<?php

namespace App\Filament\Resources\Payments\Pages;

use App\Filament\Resources\Payments\PaymentResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Invoice;


class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $invoice = Invoice::find($data['invoice_id']);

        $data['gym_id'] = $invoice->gym_id;

        return $data;
    }
}

