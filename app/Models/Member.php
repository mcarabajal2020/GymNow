<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'gym_id',
        'first_name',
        'last_name',
        'dni',
        'phone',
        'email',
        'birth_date',
        'status',
        'notes',
        'plan_id',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (auth()->check() && auth()->user()->gym_id) {
                $model->gym_id = auth()->user()->gym_id;
            }
        });
    }
    // Relaciones
    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function workouts()
    {
        return $this->belongsToMany(
            Workout::class,
            'member_workouts'
        )->withPivot(['start_date', 'active'])
         ->withTimestamps();
    }

    public function exerciseLogs()
    {
        return $this->hasMany(MemberExerciseLog::class);
    }
    public function plan()
    {
        return $this->belongsTo(\App\Models\Plan::class);
    }


    // Estado de cuota dinámico
    public function isActive()
    {
        $lastPayment = $this->payments()
            ->latest('end_date')
            ->first();

        return $lastPayment && $lastPayment->end_date >= now();
    }
}
