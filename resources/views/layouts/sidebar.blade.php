<div class="sidebar" id="sidebar">

    {{-- Logo --}}
    <div class="logo">
        <span>SEKRETARIAT</span>
    </div>

    {{-- Dashboard --}}
    <a href="{{ route('dashboard') }}"
       class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"
       data-bs-toggle="tooltip"
       data-bs-placement="right"
       title="Dashboard">

        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>

    </a>

    {{-- ========================= --}}
    {{-- ADMIN --}}
    {{-- ========================= --}}
    @if(Auth::user()->role == 'admin')

        <a href="{{ route('users.index') }}"
           class="{{ request()->routeIs('users.*') ? 'active' : '' }}"
           data-bs-toggle="tooltip"
           data-bs-placement="right"
           title="Data User">

            <i class="bi bi-people"></i>
            <span>Data User</span>

        </a>

        <a href="{{ route('kegiatan.index') }}"
           class="{{ request()->routeIs('kegiatan.*') ? 'active' : '' }}"
           data-bs-toggle="tooltip"
           data-bs-placement="right"
           title="Data Kegiatan">

            <i class="bi bi-calendar-event"></i>
            <span>Data Kegiatan</span>

        </a>

        <a href="{{ route('spj.index') }}"
           class="{{ request()->routeIs('spj.*') ? 'active' : '' }}"
           data-bs-toggle="tooltip"
           data-bs-placement="right"
           title="Data SPJ">

            <i class="bi bi-folder2-open"></i>
            <span>Data SPJ</span>

        </a>

        <a href="{{ route('verifikasi.index') }}"
           class="{{ request()->routeIs('verifikasi.*') ? 'active' : '' }}"
           data-bs-toggle="tooltip"
           data-bs-placement="right"
           title="Verifikasi">

            <i class="bi bi-check-circle"></i>
            <span>Verifikasi</span>

        </a>

        <a href="{{ route('laporan.index') }}"
           class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}"
           data-bs-toggle="tooltip"
           data-bs-placement="right"
           title="Laporan">

            <i class="bi bi-file-earmark-bar-graph"></i>
            <span>Laporan</span>

        </a>

    @endif

    {{-- ========================= --}}
    {{-- USER --}}
    {{-- ========================= --}}
    @if(Auth::user()->role == 'user')

        <a href="{{ route('spj.index') }}"
           class="{{ request()->routeIs('spj.*') ? 'active' : '' }}"
           data-bs-toggle="tooltip"
           data-bs-placement="right"
           title="Data SPJ">

            <i class="bi bi-folder2-open"></i>
            <span>Data SPJ</span>

        </a>

    @endif

    {{-- ========================= --}}
    {{-- PIMPINAN --}}
    {{-- ========================= --}}
    @if(Auth::user()->role == 'pimpinan')

        <a href="{{ route('pimpinan.index') }}"
           class="{{ request()->routeIs('pimpinan.*') ? 'active' : '' }}"
           data-bs-toggle="tooltip"
           data-bs-placement="right"
           title="Persetujuan">

            <i class="bi bi-person-check"></i>
            <span>Persetujuan</span>

        </a>

        <a href="{{ route('laporan.index') }}"
           class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}"
           data-bs-toggle="tooltip"
           data-bs-placement="right"
           title="Laporan">

            <i class="bi bi-file-earmark-bar-graph"></i>
            <span>Laporan</span>

        </a>

    @endif

    <hr class="text-white">

    <form method="POST"
          action="{{ route('logout') }}"
          class="px-3">

        @csrf

        <button
            type="submit"
            class="btn btn-danger w-100 d-flex align-items-center justify-content-center">

            <i class="bi bi-box-arrow-right"></i>

            <span class="ms-2">Logout</span>

        </button>

    </form>

</div>