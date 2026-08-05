@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Data Kegiatan</h3>

        <div class="d-flex">

            <form action="{{ route('kegiatan.index') }}"
                method="GET"
                class="me-2">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari kegiatan..."
                    value="{{ $search }}">

            </form>

            <a href="{{ route('kegiatan.create') }}"
            class="btn btn-primary">

                <i class="bi bi-plus-circle"></i>

                Tambah Kegiatan

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
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($kegiatan as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->keterangan }}</td>

                        <td>

                            <a href="{{ route('kegiatan.edit',$item->id) }}"
                                class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('kegiatan.destroy',$item->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus kegiatan ini?')">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada data kegiatan.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $kegiatan->withQueryString()->links() }}

            </div>

        </div>

    </div>

</div>

@endsection