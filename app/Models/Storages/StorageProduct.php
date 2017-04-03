<?php

namespace App\Models\Storages;

use Illuminate\Database\Eloquent\Model;

class StorageProduct extends Model
{
    /** The attributes that are mass assignable. */
    protected $fillable = [

    ];

    /** The attributes that should be hidden for arrays. */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

   /* public function storage()
    {
        return $this->hasOne('App\Models\Storages\Storage', 'id', 'storage');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Products\Product', 'id', 'product');
    }*/
}
