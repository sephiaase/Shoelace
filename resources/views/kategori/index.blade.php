@extends('layouts.app')

@section('content')

<div class="page active">
    <div class="master-content active" id="master-kategori">

        <div class="page-header">
            <h1 class="page-title">
                Catatan Kelengkapan Kategori Barang
            </h1>

            <p class="page-sub">
                Lihat dan validasi stok barang tiap kategori.
            </p>
        </div>

        <div class="master-toolbar">

            <div class="inventory-tabs">

                <a href="{{ route('kategori.index') }}"
                    class="tab-btn {{ !$filter ? 'active' : '' }}">
                    Semua
                </a>

                @foreach($filterKategori as $item)

                <a href="{{ route('kategori.index', [
                'filter' => $item->nama_kategori
            ]) }}"
                    class="tab-btn {{ $filter == $item->nama_kategori ? 'active' : '' }}">
                    {{ $item->nama_kategori }}
                </a>

                @endforeach

            </div>

            <a href="{{ route('kategori.create') }}"
                class="btn-add">
                + Tambah Data
            </a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Jumlah Barang</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($kategoris as $item)
                    <tr>

                        <td>{{ $item->id }}</td>

                        <td>{{ $item->nama_kategori }}</td>

                        <td>
                            {{ $item->barangs_count }}
                        </td>

                        <td>
                            <span class="status tersedia">
                                Aktif
                            </span>
                        </td>

                        <td class="action-cell">

                            <a href="{{ route('kategori.edit', $item->id) }}"
                                class="btn-action">
                                Edit
                            </a>

                            <a href="{{ route('kategori.show', $item->id) }}"
                                class="btn-action">
                                Detail
                            </a>

                            <form action="{{ route('kategori.destroy', $item->id) }}"
                                method="POST"
                                style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn-delete"
                                    onclick="return confirm('Hapus kategori ini?')">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>
                    @empty

                    <tr>
                        <td colspan="5" style="text-align:center">
                            Belum ada data kategori
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection