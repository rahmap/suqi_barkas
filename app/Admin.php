<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    protected $fillable = [
        'email',
        'nama',
        'password',
        'role'
    ];
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $hidden = [
      'password'
    ];

    public function products()
    {
        return $this->hasMany('\App\Product','admin_id','id');
    }
}
