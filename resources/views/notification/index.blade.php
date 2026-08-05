@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h3>Semua Notifikasi</h3>

        @if($notifications->where('is_read', false)->count() > 0)

            <form action="{{ route('notification.readAll') }}" method="POST">

                @csrf

                <button class="btn btn-outline-primary btn-sm">

                    <i class="bi bi-check2-all"></i>

                    Tandai Semua Dibaca

                </button>

            </form>

        @endif

    </div>

    <div class="card dashboard-card">

        <div class="card-body">

            @forelse($notifications as $item)

                <div class="d-flex align-items-start border-bottom py-3 {{ !$item->is_read ? 'bg-light' : '' }}">

                    <div class="flex-grow-1">

                        <strong>{{ $item->title }}</strong>

                        <br>

                        <span>{{ $item->message }}</span>

                        <br>

                        <small class="text-muted">

                            {{ $item->created_at->diffForHumans() }}

                        </small>

                    </div>

                    @if(!$item->is_read)

                        <a href="{{ route('notification.read', $item->id) }}"
                           class="btn btn-sm btn-outline-success ms-2">

                            <i class="bi bi-check2"></i>

                        </a>

                    @else

                        <span class="badge bg-secondary ms-2">Dibaca</span>

                    @endif

                </div>

            @empty

                <p class="text-center text-muted my-4">

                    Belum ada notifikasi.

                </p>

            @endforelse

            <div class="mt-3">

                {{ $notifications->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
