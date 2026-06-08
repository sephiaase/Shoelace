@extends('layouts.app')

@section('content')

<div class="page active">

    <div class="page-header">

        <h1 class="page-title">
            Detail Kategori Barang
        </h1>

        <p class="page-sub">
            Informasi kategori dan daftar barang.
        </p>

    </div>

    <div class="card">

        <div style="margin-bottom:20px">

            <h3>
                {{ $kategori->nama_kategori }}
            </h3>

            <p>
                Jumlah Barang :
                <strong>
                    {{ $kategori->barangs->count() }}
                </strong>
            </p>

        </div>

        <div class="table-wrap">

            <table>

                <thead>

                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($kategori->barangs as $barang)

                        <tr>

                            <td>
                                {{ $barang->kode_barang }}
                            </td>

                            <td>
                                {{ $barang->nama_barang }}
                            </td>

                            <td>
                                Rp {{ number_format($barang->harga,0,',','.') }}
                            </td>

                            <td>
                                {{ $barang->stok }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4">
                                Belum ada barang
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div style="margin-top:20px">

            <a href="{{ route('kategori.index') }}"
               class="btn-action">
                Kembali
            </a>

        </div>

    </div>

</div>

@endsection