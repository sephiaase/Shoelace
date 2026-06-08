<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiStok;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();

        $totalMasuk = TransaksiStok::where(
            'jenis_transaksi',
            'masuk'
        )->sum('jumlah');

        $totalKeluar = TransaksiStok::where(
            'jenis_transaksi',
            'keluar'
        )->sum('jumlah');

        $stokTerendah = Barang::orderBy('stok')
            ->first();

        $stokTertinggi = Barang::orderByDesc('stok')
            ->first();

        $stokMenipis = Barang::where('stok', '<', 10)
            ->orderBy('stok')
            ->get();

        $stokTerbanyak = Barang::orderByDesc('stok')
            ->take(5)
            ->get();

        return view(
            'dashboard.index',
            compact(
                'totalBarang',
                'totalMasuk',
                'totalKeluar',
                'stokTerendah',
                'stokTertinggi',
                'stokMenipis',
                'stokTerbanyak'
            )
        );
    }
}