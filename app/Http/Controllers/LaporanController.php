<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiStok;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = TransaksiStok::with('barang');

        if ($request->tanggal_awal) {
            $query->whereDate(
                'tanggal',
                '>=',
                $request->tanggal_awal
            );
        }

        if ($request->tanggal_akhir) {
            $query->whereDate(
                'tanggal',
                '<=',
                $request->tanggal_akhir
            );
        }

        $laporans = $query
            ->latest()
            ->paginate(10);

        $totalMasuk = clone $query;
        $totalMasuk = $totalMasuk
            ->where('jenis_transaksi', 'masuk')
            ->sum('jumlah');

        $totalKeluar = clone $query;
        $totalKeluar = $totalKeluar
            ->where('jenis_transaksi', 'keluar')
            ->sum('jumlah');

        $totalStokSaatIni = Barang::sum('stok');
        
        return view(
            'laporan.index',
            compact(
                'laporans',
                'totalMasuk',
                'totalKeluar',
                'totalStokSaatIni'
            )
        );
    }

    public function pdf(Request $request)
    {
        $query = TransaksiStok::with('barang');

        if ($request->tanggal_awal) {
            $query->whereDate(
                'tanggal',
                '>=',
                $request->tanggal_awal
            );
        }

        if ($request->tanggal_akhir) {
            $query->whereDate(
                'tanggal',
                '<=',
                $request->tanggal_akhir
            );
        }

        $laporans = $query
            ->latest()
            ->get();

        $pdf = Pdf::loadView(
            'laporan.pdf',
            compact('laporans')
        );

        return $pdf->download(
            'laporan-persediaan-shoelace.pdf'
        );
    }
}