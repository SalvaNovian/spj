@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

    {{-- Welcome Header --}}
    <div class="dashboard-welcome d-flex flex-wrap justify-content-between align-items-center">

        <div>

            <h3>Selamat Datang, {{ auth()->user()->nama }}</h3>

            <p>Pantau dan kelola persetujuan dokumen SPJ.</p>

        </div>

        <div class="date-badge mt-2 mt-md-0">

            <i class="bi bi-calendar3"></i>

            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}

        </div>

    </div>


    {{-- Stat Cards --}}
    <div class="row g-4 mb-4">

        <div class="col-xl-4 col-md-6">

            <div class="stat-card">

                <div class="d-flex justify-content-between align-items-start">

                    <div class="stat-icon amber">
                        <i class="bi bi-hourglass-split"></i>
                    </div>

                </div>

                <div class="stat-value">{{ $menunggu }}</div>

                <div class="stat-label">Menunggu Persetujuan</div>

            </div>

        </div>

        <div class="col-xl-4 col-md-6">

            <div class="stat-card">

                <div class="d-flex justify-content-between align-items-start">

                    <div class="stat-icon green">
                        <i class="bi bi-check-circle"></i>
                    </div>

                </div>

                <div class="stat-value">{{ $final }}</div>

                <div class="stat-label">Final</div>

            </div>

        </div>

        <div class="col-xl-4 col-md-6">

            <div class="stat-card">

                <div class="d-flex justify-content-between align-items-start">

                    <div class="stat-icon red">
                        <i class="bi bi-x-circle"></i>
                    </div>

                </div>

                <div class="stat-value">{{ $ditolak }}</div>

                <div class="stat-label">Ditolak</div>

            </div>

        </div>

    </div>


    {{-- SPJ Terbaru + Aktivitas Terbaru --}}
    <div class="row g-4 mb-4">

        <div class="col-lg-8">

            <div class="card dash-section-card h-100">

                <div class="card-header d-flex align-items-center gap-2">

                    <i class="bi bi-clock-history"></i> 5 SPJ Terbaru

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table dash-table table-hover mb-0">

                            <thead>

                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>Nomor SPJ</th>
                                    <th>Kegiatan</th>
                                    <th>User</th>
                                    <th>Status</th>
                                </tr>

                            </thead>

                            <tbody>

                            @forelse($spjTerbaru as $item)

                                <tr>
                                    <td class="ps-4">{{ $loop->iteration }}</td>
                                    <td>{{ $item->nomor_spj }}</td>
                                    <td>{{ $item->kegiatan->nama ?? '-' }}</td>
                                    <td>{{ $item->user->nama ?? '-' }}</td>
                                    <td>
                                        @switch($item->status)
                                            @case('diterima')
                                                <span class="badge bg-primary">Diterima</span>
                                                @break
                                            @case('final')
                                                <span class="badge bg-success">Final</span>
                                                @break
                                            @case('ditolak')
                                                <span class="badge bg-danger">Ditolak</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                                        @endswitch
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        Belum ada data SPJ.
                                    </td>
                                </tr>

                            @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card dash-section-card h-100">

                <div class="card-header d-flex align-items-center gap-2">

                    <i class="bi bi-activity"></i> Aktivitas Terbaru

                </div>

                <div class="card-body">

                    @forelse($notifications as $notif)

                        <div class="activity-item">

                            <div class="activity-dot"></div>

                            <div>
                                <div class="activity-text">{{ $notif->title }}</div>
                                <div class="activity-time">{{ $notif->created_at->diffForHumans() }}</div>
                            </div>

                        </div>

                    @empty

                        <div class="text-muted text-center py-3">

                            Belum ada aktivitas.

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>


    {{-- Quick Action --}}
    <div class="card dash-section-card mb-4">

        <div class="card-header d-flex align-items-center gap-2">

            <i class="bi bi-lightning"></i> Aksi Cepat

        </div>

        <div class="card-body">

            <div class="d-flex flex-wrap gap-3">

                <a href="{{ route('pimpinan.index') }}" class="quick-action-btn">
                    <i class="bi bi-person-check"></i> Persetujuan SPJ
                </a>

                <a href="{{ route('laporan.index') }}" class="quick-action-btn">
                    <i class="bi bi-file-earmark-bar-graph"></i> Laporan
                </a>

                <a href="{{ route('notification.index') }}" class="quick-action-btn">
                    <i class="bi bi-bell"></i> Notifikasi
                </a>

            </div>

        </div>

    </div>

</div>

@endsection