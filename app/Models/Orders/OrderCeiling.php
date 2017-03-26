<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;

class OrderCeiling extends Model
{
    /** The attributes that are mass assignable. */
    protected $fillable = [

    ];

    /** The attributes that should be hidden for arrays. */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
