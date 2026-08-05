@extends('layouts.dashboard')

@section('content')

<div class="container">

<div class="card dashboard-card">

<div class="card-header bg-primary text-white">

Tambah Kegiatan

</div>

<div class="card-body">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('kegiatan.store') }}" method="POST">

@csrf

<div class="mb-3">

<label>Kode</label>

<input
type="text"
name="kode"
class="form-control @error('kode') is-invalid @enderror"
value="{{ old('kode') }}"
required>

</div>

<div class="mb-3">

<label>Nama Kegiatan</label>

<input
type="text"
name="nama"
class="form-control @error('nama') is-invalid @enderror"
value="{{ old('nama') }}"
required>

</div>

<div class="mb-3">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control @error('tanggal') is-invalid @enderror"
value="{{ old('tanggal') }}"
required>

</div>

<div class="mb-3">

<label>Lokasi</label>

<input
type="text"
name="lokasi"
class="form-control @error('lokasi') is-invalid @enderror"
value="{{ old('lokasi') }}"
required>

</div>

<div class="mb-3">

<label>Keterangan</label>

<textarea
name="keterangan"
class="form-control @error('keterangan') is-invalid @enderror"
rows="4">{{ old('keterangan') }}</textarea>

</div>

<button type="submit" class="btn btn-primary">

Simpan

</button>

<a href="{{ route('kegiatan.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

@endsection