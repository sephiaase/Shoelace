@extends('layouts.app')

@section('content')

<div class="page active">
    <div class="master-content active" id="master-barang">
        <div class="page-header">
            <h1 class="page-title">
                Catatan Kelengkapan Daftar Barang
            </h1>
            <p class="page-sub">
                Lihat dan validasi stok barang tiap kategori.
            </p>
        </div>

        <div class="master-toolbar">

            <form
                method="GET"
                action="{{ route('barang.index') }}">

                <select
                    name="sort"
                    class="sort-dropdown"
                    onchange="this.form.submit()">

                    <option value="">
                        Urutkan Berdasarkan
                    </option>

                    <option value="nama_asc"
                        {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>
                        Nama A - Z
                    </option>

                    <option value="nama_desc"
                        {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>
                        Nama Z - A
                    </option>

                    <option value="stok_desc"
                        {{ request('sort') == 'stok_desc' ? 'selected' : '' }}>
                        Stok Terbanyak
                    </option>

                    <option value="stok_asc"
                        {{ request('sort') == 'stok_asc' ? 'selected' : '' }}>
                        Stok Tersedikit
                    </option>

                    <option value="harga_desc"
                        {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>
                        Harga Tertinggi
                    </option>

                    <option value="harga_asc"
                        {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>
                        Harga Terendah
                    </option>

                </select>

            </form>

            <a href="{{ route('barang.create') }}"
                class="btn-add">
                + Tambah Data
            </a>

        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($barangs as $barang)

                    <tr>
                        <td>{{ $barang->kode_barang }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                        <td>Rp {{ number_format($barang->harga,0,',','.') }}</td>
                        <td>{{ $barang->stok }}</td>

                        <td class="action-cell">

                            <a href="{{ route('barang.edit',$barang->id) }}"
                                class="btn-action">
                                Edit
                            </a>

                            <a href="{{ route('barang.show',$barang->id) }}"
                                class="btn-action">
                                Detail
                            </a>

                            <form action="{{ route('barang.destroy',$barang->id) }}"
                                method="POST"
                                style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn-delete"
                                    onclick="return confirm('Hapus barang ini?')">
                                    Hapus
                                </button>

                            </form>

                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" style="text-align:center">
                            Belum ada data barang
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection