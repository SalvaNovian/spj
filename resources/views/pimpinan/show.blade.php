@extends('layouts.dashboard')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-primary text-white">

            Persetujuan SPJ

        </div>

        <div class="card-body">

            <table class="table">

                <tr>
                    <th width="200">Nomor SPJ</th>
                    <td>{{ $spj->nomor_spj }}</td>
                </tr>

                <tr>
                    <th>Kegiatan</th>
                    <td>{{ $spj->kegiatan->nama }}</td>
                </tr>

                <tr>
                    <th>User</th>
                    <td>{{ $spj->user->nama }}</td>
                </tr>

                <tr>
                    <th>Tanggal</th>
                    <td>{{ $spj->tanggal }}</td>
                </tr>

                <tr>
                    <th>File</th>
                    <td>

                        <a href="{{ asset('storage/spj/'.$spj->file) }}"
                           target="_blank"
                           class="btn btn-info">

                            Lihat PDF

                        </a>

                    </td>

                </tr>

            </table>

            <hr>

            <form action="{{ route('pimpinan.update',$spj->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Keputusan</label>

                    <select name="status"
                            class="form-control"
                            required>

                        <option value="">-- Pilih --</option>

                        <option value="final">

                            Final

                        </option>

                        <option value="ditolak">

                            Ditolak

                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Catatan Pimpinan</label>

                    <textarea
                        name="catatan"
                        rows="4"
                        class="form-control">{{ old('catatan', $spj->catatan) }}</textarea>

                    @error('catatan')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <button class="btn btn-success">

                    Simpan Keputusan

                </button>

                <a href="{{ route('pimpinan.index') }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection