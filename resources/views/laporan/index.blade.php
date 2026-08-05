@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Laporan SPJ</h3>

        <form action="{{ route('laporan.index') }}"
              method="GET"
              class="d-flex">

            <input
                type="text"
                name="search"
                class="form-control me-2"
                placeholder="Cari SPJ..."
                value="{{ $search }}">

            <button class="btn btn-primary">

                <i class="bi bi-search"></i>

            </button>

        </form>

    </div>

    <div class="mb-3">

        <a href="{{ route('laporan.pdf') }}"
           class="btn btn-danger">

            <i class="bi bi-file-earmark-pdf"></i>

            Export PDF

        </a>

        <a href="{{ route('laporan.export.excel') }}"
           class="btn btn-success">

            <i class="bi bi-file-earmark-excel"></i>

            Export Excel

        </a>

    </div>

    <div class="card dashboard-card">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>

                        <th>No</th>
                        <th>No SPJ</th>
                        <th>Kegiatan</th>
                        <th>User</th>
                        <th>Tanggal</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($spjs as $spj)

                    <tr>

                        <td>{{ $spjs->firstItem()+$loop->index }}</td>

                        <td>{{ $spj->nomor_spj }}</td>

                        <td>{{ $spj->kegiatan->nama }}</td>

                        <td>{{ $spj->user->nama }}</td>

                        <td>{{ $spj->tanggal }}</td>

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

                            @endswitch

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            Tidak ada data.

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