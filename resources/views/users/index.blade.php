@extends('layouts.app')

@section('content')

<div class="page active">

    <div class="page-header">
        <h1 class="page-title">
            Manajemen Pengguna
        </h1>

        <p class="page-sub">
            Kelola data pengguna sistem Shoelace.
        </p>
    </div>

    <div class="master-toolbar">

        <span class="role-chip">
            Total User :
            {{ $users->count() }}
        </span>

        <a href="{{ route('user.create') }}"
           class="btn-add">
            + Tambah Pengguna
        </a>

    </div>

    <div class="table-wrap">

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                    <tr>

                        <td>
                            {{ $user->id }}
                        </td>

                        <td>
                            {{ $user->name }}
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        <td>
                            {{ $user->created_at->format('d-m-Y') }}
                        </td>

                        <td class="action-cell">

                            <a href="{{ route('user.edit', $user->id) }}"
                               class="btn-action">
                                Edit
                            </a>

                            <a href="{{ route('user.show', $user->id) }}"
                               class="btn-action">
                                Detail
                            </a>

                            <form
                                action="{{ route('user.destroy', $user->id) }}"
                                method="POST"
                                style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn-delete"
                                    onclick="return confirm('Hapus pengguna ini?')">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5">
                            Tidak ada data pengguna
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection