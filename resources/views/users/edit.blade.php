@extends('layouts.dashboard')

@section('content')

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-warning">
Edit User
</div>

<div class="card-body">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('users.update',$user->id) }}" method="POST">

@csrf
@method('PUT')

<div class="mb-3">
<label>Nama</label>
<input
type="text"
name="nama"
class="form-control"
value="{{ old('nama', $user->nama) }}"
required>
</div>

<div class="mb-3">
<label>NIP</label>
<input
type="text"
name="nip"
class="form-control"
value="{{ old('nip', $user->nip) }}"
required>
</div>

<div class="mb-3">
<label>Jabatan</label>
<input
type="text"
name="jabatan"
class="form-control"
value="{{ old('jabatan', $user->jabatan) }}"
required>
</div>

<div class="mb-3">
<label>Username</label>
<input
type="text"
name="username"
class="form-control"
value="{{ old('username', $user->username) }}"
required>
</div>

<div class="mb-3">
<label>Role</label>

<select
name="role"
class="form-select">

<option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
Admin
</option>

<option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
User
</option>

<option value="pimpinan" {{ old('role', $user->role) == 'pimpinan' ? 'selected' : '' }}>
Pimpinan
</option>

</select>

</div>

<div class="mb-3">

<label>Password Baru</label>

<input
type="password"
name="password"
class="form-control">

<small class="text-muted">
Kosongkan jika password tidak diganti
</small>

</div>

<button class="btn btn-warning">
Update
</button>

<a href="{{ route('users.index') }}" class="btn btn-secondary">
Kembali
</a>

</form>

</div>

</div>

</div>

@endsection