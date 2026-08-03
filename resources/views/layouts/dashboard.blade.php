@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-3">

        <div class="card dashboard-card">

            <div class="card-body">

                <h6>Total User</h6>

                <h2>0</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card dashboard-card">

            <div class="card-body">

                <h6>Total SPJ</h6>

                <h2>0</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card dashboard-card">

            <div class="card-body">

                <h6>Menunggu</h6>

                <h2>0</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card dashboard-card">

            <div class="card-body">

                <h6>Final</h6>

                <h2>0</h2>

            </div>

        </div>

    </div>

</div>

<div class="card dashboard-card mt-4">

    <div class="card-header">

        SPJ Terbaru

    </div>

    <div class="card-body">

        Belum ada data.

    </div>

</div>

@endsection