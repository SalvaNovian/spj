@extends('layouts.dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h3>Data User</h3>

    <div class="d-flex">

        <form action="{{ route('users.index') }}"
              method="GET"
              class="me-2">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari nama, username, NIP..."
                value="{{ $search }}">

        </form>

        <a href="{{ route('users.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Tambah User

        </a>

    </div>

</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card dashboard-card">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-primary">

                <tr>

                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Jabatan</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($users as $user)

                <tr>

                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->nip }}</td>
                    <td>{{ $user->jabatan }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ ucfirst($user->role) }}</td>

                    <td>
                        @if($user->status)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('users.edit', $user->id) }}"
                            class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>

                        <form action="{{ route('users.destroy', $user) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus user ini?')"
                                class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Hapus
                            </button>

                        </form>
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="text-center">

                        Belum ada data

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $users->withQueryString()->links() }}

        </div>

    </div>

</div>

@endsection