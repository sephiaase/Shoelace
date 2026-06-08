<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiStok;
use Illuminate\Http\Request;

class PersediaanController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter');

        // TAB STOK SAAT INI
        if ($filter == 'stok') {

            $barangs = Barang::with([
                'kategori',
                'transaksiStoks'
            ])
                ->orderBy('nama_barang')
                ->paginate(10);

            return view(
                'persediaan.index',
                compact(
                    'barangs',
                    'filter'
                )
            );
        }

        // SEMUA / MASUK / KELUAR
        $query = TransaksiStok::with('barang');

        if ($filter == 'masuk') {
            $query->where(
                'jenis_transaksi',
                'masuk'
            );
        }

        if ($filter == 'keluar') {
            $query->where(
                'jenis_transaksi',
                'keluar'
            );
        }

        $transaksis = $query
            ->latest()
            ->paginate(10);

        return view(
            'persediaan.index',
            compact(
                'transaksis',
                'filter'
            )
        );
    }
}
