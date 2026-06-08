<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter;

        $query = KategoriBarang::withCount('barangs');

        if ($filter) {
            $query->where(
                'nama_kategori',
                $filter
            );
        }

        if ($filter) {
            $query->where('nama_kategori', $filter);
        }

        $kategoris = $query
            ->orderBy('nama_kategori')
            ->get();

        $filterKategori = KategoriBarang::select('nama_kategori')
            ->distinct()
            ->orderBy('nama_kategori')
            ->get();

        return view(
            'kategori.index',
            compact(
                'kategoris',
                'filterKategori',
                'filter'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:100'
        ]);

        KategoriBarang::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->back()
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $kategori = KategoriBarang::with('barangs')
            ->findOrFail($id);

        return view(
            'kategori.show',
            compact('kategori')
        );
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function edit(string $id)
    {
        $kategori = KategoriBarang::findOrFail($id);

        return view(
            'kategori.edit',
            compact('kategori')
        );
    }

    public function update(Request $request, string $id)
    {
        $kategori = KategoriBarang::findOrFail($id);

        $request->validate([
            'nama_kategori' =>
            'required|max:100|unique:kategori_barangs,nama_kategori,' . $id
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->back()
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $kategori = KategoriBarang::findOrFail($id);

        $kategori->delete();

        return redirect()->back()
            ->with('success', 'Kategori berhasil dihapus');
    }
}
