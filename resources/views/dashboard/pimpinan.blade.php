@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">

        Dashboard Pimpinan

    </h3>

    <div class="row">

        <div class="col-md-4">

            <div class="card border-primary shadow">

                <div class="card-body text-center">

                    <h6>Menunggu Persetujuan</h6>

                    <h2>{{ $menunggu }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-success shadow">

                <div class="card-body text-center">

                    <h6>Final</h6>

                    <h2>{{ $final }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-danger shadow">

                <div class="card-body text-center">

                    <h6>Ditolak</h6>

                    <h2>{{ $ditolak }}</h2>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection