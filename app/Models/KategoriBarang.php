<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    public function barangs()
    {
        return $this->hasMany(
            Barang::class,
            'kategori_barang_id'
        );
    }

    protected $fillable = [
        'nama_kategori'
    ];
}
