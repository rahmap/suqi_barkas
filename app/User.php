<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama','email','password','phone','provinsi','kabupaten','is_active','created_at','location'
    ];

    public $timestamps = ['created_at']; //only want to used created_at column
    const UPDATED_AT = null; //and updated by default null set

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    
    public function products()
    {
        return $this->hasMany('App\Product');
    }

}
