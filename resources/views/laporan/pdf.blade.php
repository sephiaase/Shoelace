<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">

```
<style>

    body{
        font-family: DejaVu Sans;
        font-size:12px;
    }

    h2{
        text-align:center;
    }

    table{
        width:100%;
        border-collapse:collapse;
        margin-top:20px;
    }

    table,th,td{
        border:1px solid #000;
    }

    th{
        background:#f2f2f2;
    }

    th,td{
        padding:8px;
        text-align:left;
    }

</style>
```

</head>

<body>

<h2>
Laporan Persediaan Barang Shoelace
</h2>

<table>

```
<thead>
    <tr>
        <th>Tanggal</th>
        <th>Barang</th>
        <th>Jenis</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
    </tr>
</thead>

<tbody>

    @foreach($laporans as $laporan)

    <tr>

        <td>
            {{ $laporan->tanggal }}
        </td>

        <td>
            {{ $laporan->barang->nama_barang ?? '-' }}
        </td>

        <td>
            {{ ucfirst($laporan->jenis_transaksi) }}
        </td>

        <td>
            {{ $laporan->jumlah }}
        </td>

        <td>
            {{ $laporan->keterangan }}
        </td>

    </tr>

    @endforeach

</tbody>
```

</table>

</body>
</html>
