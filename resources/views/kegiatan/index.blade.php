@extends('layouts.app')

@section('content')

<h3>Data Kegiatan</h3>

<div class="card dashboard-card mt-3">

    <div class="card-body">

        <a href="{{ route('kegiatan.create') }}" class="btn btn-primary mb-3">
            Tambah Kegiatan
        </a>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatan as $no => $k)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $k->kode }}</td>
                            <td>{{ $k->nama }}</td>
                            <td>{{ $k->tanggal }}</td>
                            <td>{{ $k->lokasi }}</td>
                            <td>
                                <a href="{{ route('kegiatan.edit', $k) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                <form action="{{ route('kegiatan.destroy', $k) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
