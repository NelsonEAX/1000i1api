<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;

class CeilingProduct extends Model
{
    protected $table = 'ceiling_product';
    
    /** The attributes that are mass assignable. */
    protected $fillable = [

    ];

    /** The attributes that should be hidden for arrays. */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
