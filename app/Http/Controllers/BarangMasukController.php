<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuks = BarangMasuk::with('barang')
            ->latest()
            ->get();

        return view(
            'barang_masuk.index',
            compact('barangMasuks')
        );
    }

    public function create()
    {
        $barangs = Barang::all();

        return view(
            'barang_masuk.create',
            compact('barangs')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'tanggal_masuk' => 'required',
            'jumlah' => 'required|numeric'
        ]);

        BarangMasuk::create([
            'barang_id' => $request->barang_id,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan
        ]);

        $barang = Barang::findOrFail(
            $request->barang_id
        );

        $barang->stok += $request->jumlah;

        $barang->save();

        return redirect()
            ->route('barang-masuk.index');
    }
}