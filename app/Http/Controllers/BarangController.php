<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\TransaksiStok;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort;

        $query = Barang::with('kategori');

        switch ($sort) {

            case 'nama_asc':
                $query->orderBy('nama_barang', 'asc');
                break;

            case 'nama_desc':
                $query->orderBy('nama_barang', 'desc');
                break;

            case 'stok_desc':
                $query->orderBy('stok', 'desc');
                break;

            case 'stok_asc':
                $query->orderBy('stok', 'asc');
                break;

            case 'harga_desc':
                $query->orderBy('harga', 'desc');
                break;

            case 'harga_asc':
                $query->orderBy('harga', 'asc');
                break;

            default:
                $query->latest();
                break;
        }

        $barangs = $query->get();

        return view(
            'barang.index',
            compact(
                'barangs',
                'sort'
            )
        );
    }

    public function create()
    {
        $kategoris = KategoriBarang::all();

        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barangs',
            'nama_barang' => 'required',
            'kategori_barang_id' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        $barang = Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kategori_barang_id' => $request->kategori_barang_id,
            'harga' => $request->harga,
            'stok' => $request->stok
        ]);

        // otomatis catat stok awal ke laporan
        TransaksiStok::create([
            'barang_id' => $barang->id,
            'tanggal' => now(),
            'jenis_transaksi' => 'masuk',
            'jumlah' => $request->stok,
            'keterangan' => 'Stok Awal'
        ]);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);

        $kategoris = KategoriBarang::all();

        return view('barang.edit', compact(
            'barang',
            'kategoris'
        ));
    }

    public function show(string $id)
    {
        $barang = Barang::with('kategori')
            ->findOrFail($id);

        return view(
            'barang.show',
            compact('barang')
        );
    }

    public function update(Request $request, string $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $id,
            'nama_barang' => 'required',
            'kategori_barang_id' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        $barang->update($request->all());

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);

        $barang->delete();

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil dihapus');
    }
}
