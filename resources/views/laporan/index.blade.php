@extends('layouts.app')

@section('content')

<div class="page active">

    <div class="page-header">
        <h1 class="page-title">
            Laporan Persediaan Barang
        </h1>

        <p class="page-sub">
            Riwayat keluar masuk barang berdasarkan tanggal.
        </p>
    </div>

    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-label">
                Total Stok Saat Ini
            </div>

            <div class="stat-value">
                {{ $totalStokSaatIni }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">
                Total Barang Masuk
            </div>

            <div class="stat-value">
                {{ $totalMasuk }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">
                Total Barang Keluar
            </div>

            <div class="stat-value">
                {{ $totalKeluar }}
            </div>
        </div>

    </div>

    <br>

    <form method="GET"
        action="{{ route('laporan') }}"
        class="laporan-filter">

        <div class="filter-left">

            <div class="filter-item">
                <label>Dari tanggal</label>

                <input type="date"
                    name="tanggal_awal"
                    value="{{ request('tanggal_awal') }}">
            </div>

            <div class="filter-item">
                <label>Sampai tanggal</label>

                <input type="date"
                    name="tanggal_akhir"
                    value="{{ request('tanggal_akhir') }}">
            </div>

            <button type="submit"
                class="btn-filter">
                Filter
            </button>
        </div>

        <a href="{{ route('laporan.pdf', request()->all()) }}"
            class="btn-download">
            Download PDF
        </a>

    </form>

    <br>

    <div class="table-wrap">

        <table>

            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Barang</th>
                    <th>Jenis Transaksi</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>

            <tbody>

                @forelse($laporans as $laporan)

                <tr>

                    <td>
                        {{ $laporan->tanggal }}
                    </td>

                    <td>
                        {{ $laporan->barang->nama_barang ?? '-' }}
                    </td>

                    <td>

                        @if($laporan->jenis_transaksi == 'masuk')

                        <span class="status tersedia">
                            Masuk
                        </span>

                        @else

                        <span class="status kosong">
                            Keluar
                        </span>

                        @endif

                    </td>

                    <td>
                        {{ $laporan->jumlah }}
                    </td>

                    <td>
                        {{ $laporan->keterangan }}
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5">
                        Tidak ada data
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div style="margin-top:20px">
        {{ $laporans->withQueryString()->links() }}
    </div>

</div>

@endsection