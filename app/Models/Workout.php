<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = [
        'gym_id',
        'name',
        'description',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

    public function exercises()
    {
        return $this->belongsToMany(
            Exercise::class,
            'workout_exercises'
        )->withPivot([
            'series',
            'repetitions',
            'suggested_weight',
            'video_url',
            'order_column'
        ])->withTimestamps();
    }

    public function members()
    {
        return $this->belongsToMany(
            Member::class,
            'member_workouts'
        )->withPivot(['start_date', 'active'])
         ->withTimestamps();
    }
}
