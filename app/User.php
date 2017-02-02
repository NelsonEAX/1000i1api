<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    
    protected $casts = [
        'is_admin' => 'boolean',
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
        'password', 'remember_token',
    ];
    
    public function toConfirm()
    {
        $this->is_confirmed = 1;
        $this->email_token = null;
        $this->save();
    } 
    
    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function isEAX()
    {
        return $this->is_eax;
    }
}
