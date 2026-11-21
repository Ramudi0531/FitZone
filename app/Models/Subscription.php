<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'member_name',
        'membership_id',
        'start_date',
        'expiry_date',
        'status',
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}