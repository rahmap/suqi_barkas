<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'produks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'admin_id',
        'berat',
        'created_at',
        'deleted_at',
        'diskon',
        'gambar',
        'gambar_tambahan',
        'harga',
        'kategori_id',
        'keterangan',
        'nama',
        'slug',
        'is_active',
        'updated_at'
    ];

    public function kategoris()
    {
        return $this->belongsTo('\App\Kategori', 'kategori_id', 'id');
    }

    public function admins()
    {
        return $this->belongsTo('\App\Admin', 'admin_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }
}
