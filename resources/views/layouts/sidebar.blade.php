<div class="sidebar">

    <div class="logo">
        SEKETARIAT
    </div>

    <a href="{{ route('dashboard') }}">
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>

<!-- ADMIN -->
    @if(Auth::user()->role == 'admin')

        <a href="{{ route('users.index') }}">
            <i class="bi bi-people"></i>
            Data User
        </a>

        <a href="{{ route('kegiatan.index') }}">
            <i class="bi bi-calendar-event"></i>
            Data Kegiatan
        </a>

        <a href="{{ route('spj.index') }}">
            <i class="bi bi-folder2-open"></i>
            Data SPJ
        </a>

        <a href="{{ route('verifikasi.index') }}">
            <i class="bi bi-check-circle"></i>
            Verifikasi
        </a>
        

        <a href="{{ route('laporan.index') }}">
            <i class="bi bi-file-earmark-bar-graph"></i>
            Laporan
        </a>

    @endif

<!-- USER -->
    @if(Auth::user()->role == 'user')

        <a href="{{ route('spj.index') }}">
            <i class="bi bi-folder2-open"></i>
            Data SPJ 
        </a>

    @endif


<!-- PIMPINAN -->
    @if(Auth::user()->role == 'pimpinan')

        <a href="{{ route('pimpinan.index') }}">
            <i class="bi bi-person-check"></i>
            Persetujuan
        </a>

        <a href="{{ route('laporan.index') }}">
            <i class="bi bi-file-earmark-bar-graph"></i>
            Laporan
        </a>

    @endif

    <hr>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button class="btn btn-danger w-100">

            Logout

        </button>

    </form>

</div>