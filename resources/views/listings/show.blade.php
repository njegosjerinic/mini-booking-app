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
                    <li class="list-group-item"><strong>Početak rezervacije:</strong> {{ $start_date }}</li>
                    <li class="list-group-item"><strong>Kraj rezervacije:</strong> {{ $end_date }}</li>
                </ul>

                {{-- Forma za potvrdu rezervacije --}}
                <div class="justify-content-between d-flex align-items-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">← Nazad na rezultate</a>

                    <form action="{{ route('reservations.store') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        <input type="hidden" name="start_date" value="{{ $start_date }}">
                        <input type="hidden" name="end_date" value="{{ $end_date }}">
                        <button type="submit" class="btn btn-success">Rezerviši</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <h3>Recenzije</h3>
            @if(count($reviews) == 0)
                <p>Nema recenzija</p>
            @else
                <div class="card-body">
                    @foreach ($reviews as $review)
                        <div>
                            <div>
                                <strong>{{ $review->user->$name }}</strong>
                                <span> {{ $review->rating }}/5</span>
                                <p>{{ $review->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-body">
                    <form action=""></form>
                </div>
            @endif
        </div>
    </div>
@endsection

