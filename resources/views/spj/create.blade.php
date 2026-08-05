@extends('layouts.dashboard')

@section('content')

<div class="container">

    <div class="card dashboard-card">

        <div class="card-header bg-primary text-white">
            Tambah SPJ
        </div>

        <div class="card-body">

            <form action="{{ route('spj.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label>Nomor SPJ</label>

                    <input
                        type="text"
                        name="nomor_spj"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Kegiatan</label>

                    <select
                        name="kegiatan_id"
                        class="form-select"
                        required>

                        <option value="">-- Pilih Kegiatan --</option>

                        @foreach($kegiatan as $item)

                            <option value="{{ $item->id }}">
                                {{ $item->kode }} - {{ $item->nama }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="mb-3">
                    <label>Tanggal SPJ</label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">
                    <label>Upload PDF</label>

                    <input
                        type="file"
                        name="file"
                        class="form-control"
                        accept=".pdf"
                        required>

                    <small class="text-muted">
                        File harus PDF maksimal 10 MB.
                    </small>

                </div>

                <button class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('spj.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

@endsection