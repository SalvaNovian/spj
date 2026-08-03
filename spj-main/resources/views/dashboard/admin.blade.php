@extends('layouts.dashboard')

@section('content')

<div class="row">

    <div class="col-md-3">

        <div class="card dashboard-card">

            <div class="card-body">

                <h6>Total User</h6>

                <h2>1</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card dashboard-card">

            <div class="card-body">

                <h6>SPJ Masuk</h6>

                <h2>0</h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card dashboard-card">

            <div class="card-body">

                <h6>Revisi</h6>

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

        <table class="table">

            <thead>

            <tr>

                <th>No</th>

                <th>Nama</th>

                <th>Status</th>

                <th>Tanggal</th>

            </tr>

            </thead>

            <tbody>

            <tr>

                <td colspan="4" class="text-center">

                    Belum ada data.

                </td>

            </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection