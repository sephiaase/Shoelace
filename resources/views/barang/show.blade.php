@extends('layouts.app')

@section('content')

<div class="page active">

    <div class="page-header">
        <h1 class="page-title">
            Detail Barang
        </h1>

        <p class="page-sub">
            Informasi lengkap barang.
        </p>
    </div>

    <div class="card">

        <table class="detail-table">

            <tr>
                <th>Kode Barang</th>
                <td>{{ $barang->kode_barang }}</td>
            </tr>

            <tr>
                <th>Nama Barang</th>
                <td>{{ $barang->nama_barang }}</td>
            </tr>

            <tr>
                <th>Kategori</th>
                <td>{{ $barang->kategori->nama_kategori }}</td>
            </tr>

            <tr>
                <th>Harga</th>
                <td>Rp {{ number_format($barang->harga,0,',','.') }}</td>
            </tr>

            <tr>
                <th>Stok</th>
                <td>{{ $barang->stok }}</td>
            </tr>

            <tr>
                <th>Dibuat</th>
                <td>{{ $barang->created_at }}</td>
            </tr>

        </table>

        <br>

        <a href="{{ route('barang.index') }}"
           class="btn-add">
            Kembali
        </a>

    </div>

</div>

@endsection