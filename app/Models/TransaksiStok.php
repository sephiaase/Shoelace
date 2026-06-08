<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiStok extends Model
{
    protected $fillable = [
        'barang_id',
        'tanggal',
        'jenis_transaksi',
        'jumlah',
        'keterangan'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}