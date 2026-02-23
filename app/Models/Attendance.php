<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
        protected $fillable = [
        'gym_id',
        'member_id',
        'check_in',
    ];

    protected $casts = [
        'check_in' => 'datetime',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}
