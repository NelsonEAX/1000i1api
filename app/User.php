<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $casts = [
        'is_eax' => 'boolean',
        'is_admin' => 'boolean',
        'is_private' => 'boolean',
        'is_legal' => 'boolean',
        'is_manager' => 'boolean',
        'is_manager_production' => 'boolean',
        'is_cutter' => 'boolean',
        'is_shareholder' => 'boolean',
        'is_storekeeper' => 'boolean',
        'is_dealer' => 'boolean',
        'is_franchise' => 'boolean',
        'is_agent' => 'boolean',
        'is_related' => 'boolean',
        'is_measurer' => 'boolean',
        'is_installer' => 'boolean',
        'is_delivery_city' => 'boolean',
        'is_delivery_region' => 'boolean',
        'is_confirmed' => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'email_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'email_token',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    public function getUserInfo()
    {
        $this->is_confirmed = 1;
        $this->email_token = null;
        $this->save();
    }

    public function setConfirm()
    {
        $this->is_confirmed = 1;
        $this->email_token = null;
        $this->save();
    }

    public function isEAX()
    {
        return $this->is_eax;
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }
}
