@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dodaj novi smeštaj</h1>

        <form action="{{ route('admin.listings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Naziv</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="opis" class="form-label">Opis</label>
                <textarea class="form-control @error('opis') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="city_id" class="form-label">Grad</label>
                <select class="form-control @error('city_id') is-invalid @enderror" name="city_id" id="city_id">
                    <option value="">-- Odaberi grad --</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
                @error('city_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price_per_night" class="form-label">Cena po noći (EUR)</label>
                <input type="number" step="0.01" class="form-control @error('cena') is-invalid @enderror"
                    id="price_per_night" name="price_per_night" value="{{ old('price_per_night') }}">
                @error('price_per_night')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="beds" class="form-label">Broj kreveta</label>
                <input type="number" class="form-control @error('beds') is-invalid @enderror" id="beds" name="beds"
                    value="{{ old('beds') }}">
                @error('beds')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="max_persons" class="form-label">Maksimalan broj osoba</label>
                <input type="number" class="form-control @error('max_persons') is-invalid @enderror" id="max_persons"
                    name="max_persons" value="{{ old('max_persons') }}">
                @error('max_osoba')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image_path" class="form-label">Slika objekta</label>
                <input type="file" accept="image/*" class="form-control @error('image_path') is-invalid @enderror"
                    id="image_path" name="image_path">
                @error('image_path')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="justify-content-between d-flex align-items-center">
                <button type="submit" class="btn btn-success">Sačuvaj</button>
                <a href="{{ route('admin.listings.index') }}" class="btn btn-secondary">Nazad</a>
            </div>
        </form>
    </div>
@endsection
