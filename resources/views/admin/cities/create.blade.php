@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Dodaj grad</h2>

    <form action="{{ route('admin.cities.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Naziv grada</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">💾 Sačuvaj</button>
        <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">⬅ Nazad</a>
    </form>
</div>
@endsection
