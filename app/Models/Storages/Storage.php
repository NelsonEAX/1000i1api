<?php

namespace App\Models\Storages;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage as LaravelStorage;

class Storage extends Model
{
    /** The attributes that are mass assignable. */
    protected $fillable = [

    ];

    /** The attributes that should be hidden for arrays. */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

   /* public function product()
    /*{
        return $this->belongsTo('App\Models\Storage\StorageProduct', 'storage', 'id' );
    }*/

    /** КАЛЬКУЛИРУЕМЫЕ ПОЛЯ*/
    /**
     * @return 'url' - url изображения для отображения (в админке)
     */
    public function getUrlAttribute()
    {
        $dir = '';
        if ($this->attributes['user_id']) $dir = 'users/';
        if ($this->attributes['order_id']) $dir = 'orders/';
        if ($this->attributes['product_id']) $dir = 'products/';
        if ($this->attributes['category_id']) $dir = 'categories/';

        $filename = $this->attributes['uuid'];
        $extension = $this->attributes['extension'] ? '.'.$this->attributes['extension'] : '';

        return LaravelStorage::url($dir.$filename.$extension);
    }

}
