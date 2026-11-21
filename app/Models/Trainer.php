<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization',
        'experience',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}