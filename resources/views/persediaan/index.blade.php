@extends('layouts.app')

@section('content')

<div class="page active">

    <div class="page-header">
        <h1 class="page-title">
            Stok Ketersediaan Barang
        </h1>

        <p class="page-sub">
            Lihat dan validasi jumlah stok hari ini.
        </p>
    </div>

    <div class="inventory-tabs">

        <a href="{{ route('persediaan') }}"
           class="tab-btn {{ !$filter ? 'active' : '' }}">
            Semua
        </a>

        <a href="{{ route('persediaan', ['filter' => 'masuk']) }}"
           class="tab-btn {{ $filter == 'masuk' ? 'active' : '' }}">
            Barang Masuk
        </a>

        <a href="{{ route('persediaan', ['filter' => 'keluar']) }}"
           class="tab-btn {{ $filter == 'keluar' ? 'active' : '' }}">
            Barang Keluar
        </a>

        <a href="{{ route('persediaan', ['filter' => 'stok']) }}"
           class="tab-btn {{ $filter == 'stok' ? 'active' : '' }}">
            Stok Saat Ini
        </a>

    </div>

    <div class="table-wrap">

        <table>

            @if($filter == 'stok')

                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($barangs as $barang)

                        <tr>

                            <td>{{ $barang->kode_barang }}</td>

                            <td>{{ $barang->nama_barang }}</td>

                            <td>
                                {{ $barang->kategori->nama_kategori ?? '-' }}
                            </td>

                            <td>{{ $barang->stok }}</td>

                            <td>

                                @if($barang->stok <= 0)

                                    <span class="status kosong">
                                        Kosong
                                    </span>

                                @elseif($barang->stok < 10)

                                    <span class="status pengiriman">
                                        Menipis
                                    </span>

                                @else

                                    <span class="status tersedia">
                                        Tersedia
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5">
                                Tidak ada data barang
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            @else

                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Jenis Transaksi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($transaksis as $transaksi)

                        <tr>

                            <td>
                                {{ $transaksi->barang->nama_barang ?? '-' }}
                            </td>

                            <td>
                                {{ $transaksi->tanggal }}
                            </td>

                            <td>
                                {{ $transaksi->jumlah }}
                            </td>

                            <td>

                                @if($transaksi->jenis_transaksi == 'masuk')

                                    <span class="status tersedia">
                                        Barang Masuk
                                    </span>

                                @else

                                    <span class="status kosong">
                                        Barang Keluar
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $transaksi->keterangan }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5">
                                Tidak ada transaksi
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            @endif

        </table>

    </div>

    <div style="margin-top:20px;">

        @if($filter == 'stok')

            {{ $barangs->links() }}

        @else

            {{ $transaksis->links() }}

        @endif

    </div>

</div>

@endsection