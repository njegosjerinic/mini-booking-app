@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Ponuda smeštaja</h1>

    <div class="row">
        @foreach($listings as $listing)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    {{-- Slika smeštaja --}}
                    @if($listing->image_path)
                        <img src="{{ asset('storage/' . $listing->image) }}" class="card-img-top" alt="{{ $listing->name }}">
                    @else
                        <img src="https://via.placeholder.com/400x250?text=No+Image" class="card-img-top" alt="No image">
                    @endif

                    <div class="card-body d-flex flex-column">
                        {{-- Naziv i lokacija --}}
                        <h5 class="card-title">{{ $listing->name }}</h5>
                        <p class="text-muted mb-1"><i class="bi bi-geo-alt"></i> {{ $listing->city->name ?? 'Nepoznato' }}</p>

                        {{-- Cena i info --}}
                        <p class="fw-bold">{{ number_format($listing->price_per_night, 2) }} € / noć</p>
                        <p class="mb-2">
                            🛏️ {{ $listing->beds }} kreveta • 👥 Max {{ $listing->max_persons }} osoba
                        </p>

                        {{-- Dugme za detalje --}}
                        <a href="{{ route('admin.listings.edit', $listing->id) }}" class="btn btn-primary mt-auto">
                            Pogledaj detalje
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Paginacija --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $listings->links() }}
    </div>
</div>
@endsection

