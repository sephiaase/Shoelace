<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_barang_id',
        'harga',
        'stok'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_barang_id');
    }

    public function transaksiStoks()
    {
        return $this->hasMany(TransaksiStok::class);
    }
}