@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Persetujuan Pimpinan</h3>

        <form action="{{ route('pimpinan.index') }}"
              method="GET"
              class="d-flex">

            <input
                type="text"
                name="search"
                class="form-control me-2"
                placeholder="Cari No SPJ, Kegiatan, User..."
                value="{{ $search }}">

            <button class="btn btn-success">

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

        <div class="card-header bg-success text-white">

            Persetujuan Pimpinan

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-success">

                    <tr>

                        <th>No</th>
                        <th>No SPJ</th>
                        <th>Kegiatan</th>
                        <th>User</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>

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

                            <a href="{{ route('pimpinan.show',$spj->id) }}"
                               class="btn btn-success btn-sm">

                                <i class="bi bi-eye"></i>

                                Review

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            Belum ada SPJ yang menunggu persetujuan.

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