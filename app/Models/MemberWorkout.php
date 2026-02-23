<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberWorkout extends Model
{
    protected $fillable = [
        'gym_id',
        'member_id',
        'workout_id',
        'start_date',
        'active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'active' => 'boolean',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
}
