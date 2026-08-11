@php

use App\Models\Notification;

$notifications = Notification::where('user_id', auth()->id())
    ->latest()
    ->take(5)
    ->get();

$unread = Notification::where('user_id', auth()->id())
    ->where('is_read', false)
    ->count();

@endphp

<div class="topbar d-flex justify-content-between align-items-center">

    <div class="d-flex align-items-center">

        <button
            id="sidebarToggle"
            class="btn btn-icon-only me-3">

            <i class="bi bi-list"></i>

        </button>

        <h5 class="mb-0">

            DISBUDPAR

        </h5>

    </div>

    <div class="d-flex align-items-center">

        <div class="dropdown me-4">

            <button
                id="notifDropdownBtn"
                class="btn btn-icon-only position-relative"
                type="button"
                data-bs-toggle="dropdown">

                <i class="bi bi-bell"></i>

                @if($unread > 0)

                    <span id="notifBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                        {{ $unread }}

                    </span>

                @endif

            </button>

            <ul class="dropdown-menu dropdown-menu-end" style="width:350px;">

                <li>
                    <h6 class="dropdown-header">
                        Notifikasi
                    </h6>
                </li>

                @forelse($notifications as $item)

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('notification.read', $item->id) }}">

                            <strong>

                                {{ $item->title }}

                            </strong>

                            <br>

                            <small>

                                {{ $item->message }}

                            </small>

                            <br>

                            <small class="text-muted">

                                {{ $item->created_at->diffForHumans() }}

                            </small>

                        </a>

                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                @empty

                    <li>

                        <span class="dropdown-item text-muted">

                            Belum ada notifikasi.

                        </span>

                    </li>

                @endforelse

                <li>

                    <a
                        href="{{ route('notification.index') }}"
                        class="dropdown-item text-center fw-bold">

                        Lihat Semua Notifikasi

                    </a>

                </li>

            </ul>

        </div>

        <div class="d-flex align-items-center">

        <button
            id="themeToggle"
            class="btn btn-icon-only me-3"
            title="Ganti Tema">

            <i class="bi bi-moon-fill"></i>

        </button>

        <div>

            Selamat Datang,

            <b>{{ auth()->user()->nama }}</b>

        </div>

    </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('notifDropdownBtn');
    if (!btn) return;

    btn.addEventListener('shown.bs.dropdown', function () {
        const badge = document.getElementById('notifBadge');
        if (!badge) return;

        // Hilangkan badge langsung
        badge.remove();

        // Kirim AJAX untuk tandai semua dibaca
        fetch("{{ route('notification.readAll') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        });
    });
});
</script>