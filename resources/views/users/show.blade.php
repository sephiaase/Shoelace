@extends('layouts.app')

@section('content')

<div class="page active">

    <div class="page-header">
        <h1 class="page-title">
            Detail Pengguna
        </h1>

        <p class="page-sub">
            Informasi lengkap pengguna.
        </p>
    </div>

    <div class="table-wrap"
         style="
            max-width:700px;
            background:#fff;
            border-radius:18px;
            padding:20px;
         ">

        <table>

            <tbody>

                <tr>
                    <th width="220">
                        ID Pengguna
                    </th>
                    <td>
                        {{ $user->id }}
                    </td>
                </tr>

                <tr>
                    <th>
                        Nama Pengguna
                    </th>
                    <td>
                        {{ $user->name }}
                    </td>
                </tr>

                <tr>
                    <th>
                        Email
                    </th>
                    <td>
                        {{ $user->email }}
                    </td>
                </tr>

                <tr>
                    <th>
                        Tanggal Dibuat
                    </th>
                    <td>
                        {{ $user->created_at }}
                    </td>
                </tr>

                <tr>
                    <th>
                        Terakhir Diupdate
                    </th>
                    <td>
                        {{ $user->updated_at }}
                    </td>
                </tr>

            </tbody>

        </table>

        <div style="margin-top:20px">

            <a href="{{ route('user.index') }}"
               class="btn-action">
                Kembali
            </a>

        </div>

    </div>

</div>

@endsection