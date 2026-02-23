<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gym extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'cuit',
        'address',
        'phone',
        'email',
        'status',
    ];

    // Relaciones
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function workouts()
    {
        return $this->hasMany(Workout::class);
    }
}
