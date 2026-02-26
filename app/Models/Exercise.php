<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'gym_id',
        'name',
        'muscle_group',
        'default_video_url',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
    protected static function booted()
    {
        static::creating(function ($model) {
            if (auth()->check() && auth()->user()->gym_id) {
                $model->gym_id = auth()->user()->gym_id;
            }
        });
    }

    public function workouts()
    {
        return $this->belongsToMany(
            Workout::class,
            'workout_exercises'
        )->withPivot([
            'series',
            'repetitions',
            'suggested_weight',
            'video_url',
            'order_column'
        ])->withTimestamps();
    }

    public function logs()
    {
        return $this->hasMany(MemberExerciseLog::class);
    }
}
