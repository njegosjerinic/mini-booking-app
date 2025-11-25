@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Uredi smeštaj</h1>

        <form action="{{ route('admin.listings.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Naziv smještaja</label>
                <input type="text" name="name" id="name" value="{{ old('name', $listing->name) }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Opis</label>
                <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $listing->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price_per_night" class="form-label">Cjena po noći (€)</label>
                <input type="number" name="price_per_night" id="price_per_night"
                    value="{{ old('price_per_night', $listing->price_per_night) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="beds" class="form-label">Broj kreveta</label>
                <input type="number" name="beds" id="beds" value="{{ old('beds', $listing->beds) }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="max_persons" class="form-label">Maksimalan broj osoba</label>
                <input type="number" name="max_persons" id="max_persons"
                    value="{{ old('max_persons', $listing->max_persons) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="city_id" class="form-label">Grad</label>
                <select name="city_id" id="city_id" class="form-control" required>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ $listing->city_id == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image_path" class="form-label">Slika (opciono)</label>
                <input type="file" accept="image/*" name="image_path" id="image_path" class="form-control"
                value="{{ old('image_path', $listing->image_path) }}">
                @if ($listing->image_path)
                    <div class="mt-2 position-relative w-100" style="height: 200px;">
                        <img src="{{ asset('storage/' . $listing->image_path) }}"
                            class="position-absolute object-fit-cover h-100 w-100" style="inset: 0;"
                            alt="Accommodation listing main photo">
                    </div>
                @endif
            </div>

            <div class="justify-content-between d-flex align-items-center">
                <button type="submit" class="btn btn-success">Sačuvaj izmene</button>
                <a href="{{ route('admin.listings.index') }}" class="btn btn-secondary">Nazad</a>
            </div>

        </form>

        <form id="delete-listing-form-{{ $listing->id }}" action="{{ route('admin.listings.destroy', $listing->id) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger"
                onclick="confirmDeleteListing({{ $listing->id }})">
                Obriši smještaj
            </button>
        </form>
    </div>
@endsection
