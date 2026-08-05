@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Data SPJ</h3>

        <div class="d-flex">

            <form action="{{ route('spj.index') }}"
                method="GET"
                class="me-2">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari nomor SPJ, kegiatan, user..."
                    value="{{ $search }}">

            </form>

            <a href="{{ route('spj.create') }}"
            class="btn btn-primary">

                <i class="bi bi-plus-circle"></i>

                Tambah SPJ

            </a>

        </div>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))

    <div class="alert alert-danger">

        {{ session('error') }}

    </div>

    @endif

    <div class="card dashboard-card">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                    <tr>

                        <th>No</th>
                        <th>No SPJ</th>
                        <th>Kegiatan</th>
                        <th>User</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th width="180">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($spjs as $spj)

                    <tr>

                        <td>{{ $spjs->firstItem() + $loop->index }}</td>

                        <td>{{ $spj->nomor_spj }}</td>

                        <td>{{ $spj->kegiatan->nama }}</td>

                        <td>{{ $spj->user->nama }}</td>

                        <td>{{ $spj->tanggal }}</td>

                        <td>

                            <span class="badge bg-secondary">

                                {{ ucfirst($spj->status) }}

                            </span>

                        </td>

                        <td>

                            {{-- Lihat PDF --}}
                            <a href="{{ asset('storage/spj/'.$spj->file) }}"
                            target="_blank"
                            class="btn btn-info btn-sm">

                                <i class="bi bi-eye"></i>

                            </a>

                            {{-- Upload Revisi --}}
                            @if($spj->status == 'revisi' && $spj->revisi_ke < 2)

                                <a href="{{ route('spj.edit', $spj->id) }}"
                                class="btn btn-warning btn-sm">

                                    <i class="bi bi-arrow-repeat"></i>

                                </a>

                            @endif

                            {{-- Hapus --}}
                            @if(in_array($spj->status, ['menunggu','revisi','ditolak']))

                                <form action="{{ route('spj.destroy',$spj->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus SPJ ini?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            Belum ada data SPJ.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $spjs->withQueryString()->links() }}

            </div>

        </div>

    </div>

</div>

@endsection