@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Uredi korisnika</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Ime i prezime</label>
            <input type="text" name="name" id="name" 
                   value="{{ old('name', $user->name) }}" 
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email adresa</label>
            <input type="email" name="email" id="email" 
                   value="{{ old('email', $user->email) }}" 
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Uloga</label>
            <select name="role" id="role" class="form-control" required>
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Korisnik</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Sačuvaj izmene</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Nazad</a>
    </form>
</div>
@endsection
