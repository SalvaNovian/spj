@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">
        Dashboard Admin
    </h3>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h6>Total User</h6>
                    <h2>{{ $totalUser }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h6>Total Kegiatan</h6>
                    <h2>{{ $totalKegiatan }}</h2>
                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <h6>Total SPJ</h6>
                    <h2>{{ $totalSpj }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger shadow">
                <div class="card-body">
                    <h6>Menunggu Verifikasi</h6>
                    <h2>{{ $menunggu }}</h2>
                </div>
            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card border-warning shadow">
                <div class="card-body text-center">
                    <h6>Revisi</h6>
                    <h2>{{ $revisi }}</h2>
                </div>
            </div>
            
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-info shadow">
                <div class="card-body text-center">
                    <h6>Diterima Admin</h6>
                    <h2>{{ $diterima }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-success shadow">
                <div class="card-body text-center">
                    <h6>Final</h6>
                    <h2>{{ $final }}</h2>
                </div>
            </div>

        </div>

    </div>


    {{-- Card: SPJ Terbaru --}}

    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            5 SPJ Terbaru

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Nomor SPJ</th>
                        <th>Kegiatan</th>
                        <th>User</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($spjTerbaru as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

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

                        <td colspan="5" class="text-center">

                            Belum ada data.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Card: Grafik Upload SPJ Bulanan (dipindah ke luar agar tidak nested di dalam card tabel) --}}
    <div class="card mt-4 shadow">

        <div class="card-header">

            Grafik Upload SPJ Bulanan

        </div>

        <div class="card-body">

            <canvas id="chartSpj"></canvas>

        </div>

    </div>

</div>

<script>

const data = [

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

new Chart(document.getElementById('chartSpj'),{

type:'bar',

data:{

labels:[
'Jan',
'Feb',
'Mar',
'Apr',
'Mei',
'Jun',
'Jul',
'Agu',
'Sep',
'Okt',
'Nov',
'Des'
],

datasets:[{

label:'Upload SPJ',

data:data,

borderWidth:1

}]

},

options:{

responsive:true,

plugins:{

legend:{

display:true

}

}

}

});

</script>

@endsection