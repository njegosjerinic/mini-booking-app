@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-4">
            @if ($listing->image_path)
                <img src="{{ asset('storage/' . $listing->image_path) }}" class="card-img-top object-fit-cover"
                    style="height: 400px; object-fit: cover;" alt="{{ $listing->title }}">
            @endif
            <div class="card-body">
                <h2 class="card-title">{{ $listing->title }}</h2>
                <p class="card-text">{{ $listing->description }}</p>

                <ul class="list-group mb-3">
                    <li class="list-group-item"><strong>Grad:</strong> {{ $listing->city->name }}</li>
                    <li class="list-group-item"><strong>Maksimalno gostiju:</strong> {{ $listing->max_persons }}</li>
                    <li class="list-group-item"><strong>Cena po noći:</strong> €{{ $listing->price_per_night }}</li>
                </ul>

                <div class="justify-content-between d-flex align-items-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">← Nazad na rezultate</a>
                    <button type="submit" class="btn btn-success">Rezerviši</button>
                </div>
            </div>
        </div>
    </div>
@endsection
