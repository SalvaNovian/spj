@extends('layouts.dashboard')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header bg-warning text-dark">

            <h5 class="mb-0">

                Upload Revisi SPJ

            </h5>

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

            <table class="table table-bordered">

                <tr>
                    <th width="200">Nomor SPJ</th>
                    <td>{{ $spj->nomor_spj }}</td>
                </tr>

                <tr>
                    <th>Kegiatan</th>
                    <td>{{ $spj->kegiatan->nama }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>

                        <span class="badge bg-warning">

                            {{ ucfirst($spj->status) }}

                        </span>

                    </td>

                </tr>

                <tr>
                    <th>Revisi Ke</th>
                    <td>{{ $spj->revisi_ke }}</td>
                </tr>

                <tr>
                    <th>Catatan Admin</th>
                    <td>

                        {{ $spj->catatan ?? '-' }}

                    </td>

                </tr>

            </table>

            <form action="{{ route('spj.update',$spj->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Upload File PDF Baru</label>

                    <input
                        type="file"
                        name="file"
                        class="form-control"
                        accept=".pdf"
                        required>

                </div>

                <button class="btn btn-success">

                    <i class="bi bi-upload"></i>

                    Upload Revisi

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