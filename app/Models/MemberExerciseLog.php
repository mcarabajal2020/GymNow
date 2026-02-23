<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberExerciseLog extends Model
{
     protected $fillable = [
        'gym_id',
        'member_id',
        'exercise_id',
        'date',
        'weight',
        'repetitions',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'weight' => 'decimal:2',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
