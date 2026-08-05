@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Verifikasi SPJ</h3>
        <form action="{{ route('verifikasi.index') }}"
              method="GET"
              class="d-flex">

            <input
                type="text"
                name="search"
                class="form-control me-2"
                placeholder="Cari No SPJ, Kegiatan, User..."
                value="{{ $search }}">

            <button class="btn btn-primary">
                <i class="bi bi-search"></i>
            </button>

        </form>

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

                        <th width="60">No</th>
                        <th>No SPJ</th>
                        <th>Kegiatan</th>
                        <th>User</th>
                        <th>Status</th>
                        <th width="170">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($spjs as $spj)

                    <tr>

                        <td>

                            {{ $spjs->firstItem() + $loop->index }}

                        </td>

                        <td>{{ $spj->nomor_spj }}</td>

                        <td>{{ $spj->kegiatan->nama }}</td>

                        <td>{{ $spj->user->nama }}</td>

                        <td>

                            @switch($spj->status)

                                @case('menunggu')
                                    <span class="badge bg-secondary">Menunggu</span>
                                    @break

                                @case('revisi')
                                    <span class="badge bg-warning">Revisi</span>
                                    @break

                                @case('diterima')
                                    <span class="badge bg-primary">Diterima</span>
                                    @break

                                @case('final')
                                    <span class="badge bg-success">Final</span>
                                    @break

                                @case('ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                    @break

                                @default
                                    <span class="badge bg-dark">
                                        {{ ucfirst($spj->status) }}
                                    </span>

                            @endswitch

                        </td>

                        <td>

                            <a href="{{ route('verifikasi.show',$spj->id) }}"
                               class="btn btn-primary btn-sm">

                                <i class="bi bi-search"></i>

                                Verifikasi

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">

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