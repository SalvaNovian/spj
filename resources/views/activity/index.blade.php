@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

    <h3 class="mb-3">

        Riwayat Aktivitas

    </h3>

    <div class="card dashboard-card">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                    <tr>

                        <th>No</th>

                        <th>Waktu</th>

                        <th>Nama</th>

                        <th>Role</th>

                        <th>Aktivitas</th>

                        <th>IP</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($logs as $log)

                    <tr>

                        <td>{{ $logs->firstItem() + $loop->index }}</td>

                        <td>

                            {{ $log->created_at->format('d-m-Y H:i') }}

                        </td>

                        <td>

                            {{ $log->nama }}

                        </td>

                        <td>

                            <span class="badge bg-primary">

                                {{ ucfirst($log->role) }}

                            </span>

                        </td>

                        <td>

                            {{ $log->aktivitas }}

                        </td>

                        <td>

                            {{ $log->ip_address }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            Belum ada aktivitas.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $logs->links() }}

            </div>

        </div>

    </div>

</div>

@endsection