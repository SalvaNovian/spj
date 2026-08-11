@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

    {{-- Welcome Header --}}
    <div class="dashboard-welcome d-flex flex-wrap justify-content-between align-items-center">

        <div>

            <h3>Selamat Datang, {{ auth()->user()->nama }}</h3>

            <p>Kelola dan pantau dokumen SPJ Anda.</p>

        </div>

        <div class="date-badge mt-2 mt-md-0">

            <i class="bi bi-calendar3"></i>

            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}

        </div>

    </div>


    {{-- Stat Cards --}}
    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="d-flex justify-content-between align-items-start">

                    <div class="stat-icon blue">
                        <i class="bi bi-folder2-open"></i>
                    </div>

                </div>

                <div class="stat-value">{{ $totalSpj }}</div>

                <div class="stat-label">Total SPJ</div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="d-flex justify-content-between align-items-start">

                    <div class="stat-icon amber">
                        <i class="bi bi-hourglass-split"></i>
                    </div>

                </div>

                <div class="stat-value">{{ $menunggu }}</div>

                <div class="stat-label">Menunggu Verifikasi</div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="stat-card">

                <div class="d-flex justify-content-between align-items-start">

                    <div class="stat-icon red">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>

                </div>

                <div class="stat-value">{{ $revisi }}</div>

                <div class="stat-label">Revisi</div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

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

    </div>


    {{-- Grafik + Status SPJ --}}
    <div class="row g-4 mb-4">

        <div class="col-lg-8">

            <div class="card dash-section-card h-100">

                <div class="card-header d-flex align-items-center gap-2">

                    <i class="bi bi-bar-chart"></i> Grafik Upload SPJ Bulanan

                </div>

                <div class="card-body">

                    <canvas id="chartSpj"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card dash-section-card h-100">

                <div class="card-header d-flex align-items-center gap-2">

                    <i class="bi bi-pie-chart"></i> Ringkasan Status

                </div>

                <div class="card-body">

                    @php
                        $maxStatus = max($menunggu, $revisi, $diterima, $final, 1);
                    @endphp

                    <div class="status-progress-item">

                        <div class="status-progress-label">
                            <span>Menunggu Verifikasi</span>
                            <span>{{ $menunggu }}</span>
                        </div>

                        <div class="status-progress-bar">
                            <div class="status-progress-fill amber" style="width: {{ ($menunggu / $maxStatus) * 100 }}%"></div>
                        </div>

                    </div>

                    <div class="status-progress-item">

                        <div class="status-progress-label">
                            <span>Revisi</span>
                            <span>{{ $revisi }}</span>
                        </div>

                        <div class="status-progress-bar">
                            <div class="status-progress-fill red" style="width: {{ ($revisi / $maxStatus) * 100 }}%"></div>
                        </div>

                    </div>

                    <div class="status-progress-item">

                        <div class="status-progress-label">
                            <span>Diterima Admin</span>
                            <span>{{ $diterima }}</span>
                        </div>

                        <div class="status-progress-bar">
                            <div class="status-progress-fill blue" style="width: {{ ($diterima / $maxStatus) * 100 }}%"></div>
                        </div>

                    </div>

                    <div class="status-progress-item">

                        <div class="status-progress-label">
                            <span>Final</span>
                            <span>{{ $final }}</span>
                        </div>

                        <div class="status-progress-bar">
                            <div class="status-progress-fill green" style="width: {{ ($final / $maxStatus) * 100 }}%"></div>
                        </div>

                    </div>

                </div>

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
                                    <td>{{ $item->kegiatan->nama }}</td>
                                    <td>{{ $item->user->nama }}</td>
                                    <td>
                                        @switch($item->status)
                                            @case('menunggu')
                                                <span class="badge bg-secondary">Menunggu</span>
                                                @break
                                            @case('revisi')
                                                <span class="badge bg-warning">Revisi</span>
                                                @break
                                            @case('diterima')
                                                <span class="badge bg-primary">Diterima</span>
                                                @break
                                            @case('final')
                                                <span class="badge bg-success">Final</span>
                                                @break
                                            @case('ditolak')
                                                <span class="badge bg-danger">Ditolak</span>
                                                @break
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

                <a href="{{ route('users.create') }}" class="quick-action-btn">
                    <i class="bi bi-person-plus"></i> Tambah User
                </a>

                <a href="{{ route('kegiatan.create') }}" class="quick-action-btn">
                    <i class="bi bi-calendar-plus"></i> Tambah Kegiatan
                </a>

                <a href="{{ route('spj.create') }}" class="quick-action-btn">
                    <i class="bi bi-upload"></i> Upload SPJ
                </a>

                <a href="{{ route('verifikasi.index') }}" class="quick-action-btn">
                    <i class="bi bi-check-circle"></i> Verifikasi SPJ
                </a>

                <a href="{{ route('laporan.index') }}" class="quick-action-btn">
                    <i class="bi bi-file-earmark-bar-graph"></i> Laporan
                </a>

            </div>

        </div>

    </div>

</div>

<script>

const chartData = [
{{ $grafik[1] ?? 0 }},
{{ $grafik[2] ?? 0 }},
{{ $grafik[3] ?? 0 }},
{{ $grafik[4] ?? 0 }},
{{ $grafik[5] ?? 0 }},
{{ $grafik[6] ?? 0 }},
{{ $grafik[7] ?? 0 }},
{{ $grafik[8] ?? 0 }},
{{ $grafik[9] ?? 0 }},
{{ $grafik[10] ?? 0 }},
{{ $grafik[11] ?? 0 }},
{{ $grafik[12] ?? 0 }}
];

const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';

const gridColor = isDark ? 'rgba(148,163,184,.15)' : 'rgba(0,0,0,.06)';
const textColor = isDark ? '#94a3b8' : '#64748b';

new Chart(document.getElementById('chartSpj'), {

    type: 'bar',

    data: {

        labels: [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ],

        datasets: [{

            label: 'Upload SPJ',

            data: chartData,

            backgroundColor: isDark ? 'rgba(96,165,250,.6)' : 'rgba(37,99,235,.6)',

            borderColor: isDark ? '#60a5fa' : '#2563eb',

            borderWidth: 1,

            borderRadius: 6,

            borderSkipped: false

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: true,

        plugins: {

            legend: {
                display: false
            }

        },

        scales: {

            y: {
                beginAtZero: true,
                ticks: { color: textColor },
                grid: { color: gridColor }
            },

            x: {
                ticks: { color: textColor },
                grid: { display: false }
            }

        }

    }

});

</script>

@endsection