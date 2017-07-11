<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    /** The attributes that are mass assignable. */
    protected $fillable = [

    ];

    /** The attributes that should be hidden for arrays. */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
