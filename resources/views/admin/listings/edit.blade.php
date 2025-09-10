
@section('content')

<div class="container mt-4">
    <h1>✏️ Uredi smeštaj</h1>

    <form action="{{ route('admin.listings.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- jer update koristi PUT/PATCH --}}
        
        <div class="mb-3">
            <label for="name" class="form-label">Naziv smeštaja</label>
            <input type="text" name="name" id="name" value="{{ old('name', $listing->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Opis</label>
            <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $listing->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price_per_night" class="form-label">Cena po noći (€)</label>
            <input type="number" name="price_per_night" id="price_per_night" value="{{ old('price_per_night', $listing->price_per_night) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="max_persons" class="form-label">Maksimalan broj osoba</label>
            <input type="number" name="max_persons" id="max_persons" value="{{ old('max_persons', $listing->max_persons) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="city_id" class="form-label">Grad</label>
            <select name="city_id" id="city_id" class="form-control" required>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ $listing->city_id == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image_path" class="form-label">Slika (opciono)</label>
            <input type="file" name="image_path" id="image_path" class="form-control">
            @if($listing->image_path)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$listing->image_path) }}" alt="Trenutna slika" width="200">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-success">💾 Sačuvaj izmene</button>
        
        <a href="{{ route('admin.listings.index') }}" class="btn btn-secondary">⬅️ Nazad</a>

    </form>

    {{-- Dugme za brisanje --}}
    <form action="{{ route('admin.listings.destroy', $listing->id) }}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Da li ste sigurni da želite obrisati ovaj smeštaj?')">
            🗑 Obriši smeštaj
        </button>
    </form>
</div>

@endsection
