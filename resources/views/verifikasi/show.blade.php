@extends('layouts.dashboard')

@section('content')

<div class="container">

    <div class="card dashboard-card">

        <div class="card-header bg-primary text-white">

            Verifikasi SPJ

        </div>

        <div class="card-body">

            <form action="{{ route('verifikasi.update',$spj->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nomor SPJ</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $spj->nomor_spj }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>Kegiatan</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $spj->kegiatan->nama }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>User</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $spj->user->nama }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="text"
                           class="form-control"
                           value="{{ $spj->tanggal }}"
                           readonly>
                </div>

            <a href="{{ asset('storage/spj/'.rawurlencode($spj->file)) }}"
                    target="_blank"
                    class="btn btn-info">

                        <i class="bi bi-file-earmark-pdf"></i>
                        Lihat PDF

                    </a>

                    <p class="mt-2">
                        {{ $spj->file }}
                    </p>

                <div class="mb-3">
                    <label>Status</label>

                    <select name="status" class="form-select">

                        <option value="revisi">Revisi</option>

                        <option value="diterima">Diterima</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Catatan Admin</label>

                    <textarea
                        name="catatan"
                        class="form-control"
                        rows="4"></textarea>

                </div>

                <button class="btn btn-success">

                    Simpan Verifikasi

                </button>

                <a href="{{ route('verifikasi.index') }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection