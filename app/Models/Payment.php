<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $fillable = [
        'gym_id',
        'invoice_id',
        'amount',
        'payment_date',
        'payment_method',
        'status',
        'external_payment_id',
    ];

    protected $casts = [
        'payment_day' => 'date',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

   protected static function booted()
    {
        static::created(function ($payment) {

            $invoice = $payment->invoice;

            $totalPaid = $invoice->payments()->sum('amount');

            if ($totalPaid >= $invoice->amount) {
                $invoice->update([
                    'status' => 'paid'
                ]);
            }
        });

        static::creating(function ($model) {
            if (auth()->check() && auth()->user()->gym_id) {
                $model->gym_id = auth()->user()->gym_id;
            }
        });
    }
}
