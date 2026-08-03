<div class="sidebar">

    <div class="logo">
        SPJ ARSIP
    </div>

    <a href="{{ route('dashboard') }}">
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>

    <a href="{{ route('users.index') }}">
        <i class="bi bi-people"></i>
        Data User
    </a>

    <a href="{{ route('kegiatan.index') }}" class="nav-link">
        <i class="bi bi-calendar-event"></i>
        <span>Data Kegiatan</span>
    </a>

    <a href="#">
        <i class="bi bi-folder2-open"></i>
        Data SPJ
    </a>

    <a href="#">
        <i class="bi bi-check-circle"></i>
        Verifikasi
    </a>

    <a href="#">
        <i class="bi bi-file-earmark-bar-graph"></i>
        Laporan
    </a>

    <hr>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button class="btn btn-danger w-100">
            Logout
        </button>
    </form>

</div>