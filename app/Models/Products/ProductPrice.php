<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    /** СВЯЗИ */
    public function product()
    {
        return $this->belongsTo('App\Models\Products\Product');
    }

    /** Mutators */
    public function setPurchaseAttribute($value)
    {
        $this->attributes['purchase'] = intval( floatval($value) * 100 );
    }

    public function setWholesaleAttribute($value)
    {
        $this->attributes['wholesale'] = intval( floatval($value) * 100 );
    }

    public function setDealerAttribute($value)
    {
        $this->attributes['dealer'] = intval( floatval($value) * 100 );
    }

    public function setRetailAttribute($value)
    {
        $this->attributes['retail'] = intval( floatval($value) * 100 );
    }

    public function setNegotiableAttribute($value)
    {
        $this->attributes['negotiable'] = intval( floatval($value) * 100 );
    }

    /** Mutators */
    public function getPurchaseAttribute($value)
    {
        return floatval($value / 100);
    }

    public function getWholesaleAttribute($value)
    {
        return floatval($value / 100);
    }

    public function getDealerAttribute($value)
    {
        return floatval($value / 100);
    }

    public function getRetailAttribute($value)
    {
        return floatval($value / 100);
    }

    public function getNegotiableAttribute($value)
    {
        return floatval($value / 100);
    }
}
