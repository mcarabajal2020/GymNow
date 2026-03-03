<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'gym_id',
        'name',
        'price',
        'duration_days',
        'description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
    protected static function booted()
    {
        static::creating(function ($model) {
            if (auth()->check() && auth()->user()->gym_id) {
                $model->gym_id = auth()->user()->gym_id;
            }
        });
    }

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
    public function members()
    {
        return $this->hasMany(\App\Models\Member::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

}
