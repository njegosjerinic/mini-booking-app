@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-lg">
        <img src="{{ asset('storage/' . $listing->image_path) }}" class="card-img-top" alt="{{ $listing->name }}">

        <div class="card-body">
            <h1 class="card-title">{{ $listing->name }}</h1>
            <p class="text-muted">
                Lokacija: {{ $listing->city->name ?? 'Nepoznato' }}
            </p>
            <p>{{ $listing->description }}</p>

            <ul class="list-group list-group-flush my-3">
                <li class="list-group-item"><strong>Cena po noći:</strong> €{{ number_format($listing->price_per_night, 2) }}</li>
                <li class="list-group-item"><strong>Broj kreveta:</strong> {{ $listing->beds }}</li>
                <li class="list-group-item"><strong>Maksimalan broj osoba:</strong> {{ $listing->max_persons }}</li>
            </ul>

            <a href="{{ route('reservations.create', $listing->id) }}" class="btn btn-primary">
                Rezerviši sada
            </a>
            <a href="{{ route('home') }}" class="btn btn-secondary">
                Nazad na početnu
            </a>
        </div>
    </div>

</div>
@endsection
