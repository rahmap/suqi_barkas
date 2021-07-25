<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'id';
    protected $fillable = [
      'nama',
      'slug',
      'is_active'
    ];

    public $timestamps = false;

    public function produks()
    {
        return $this->hasMany('\App\Product','kategori_id','id');
    }
}
