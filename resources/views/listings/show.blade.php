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
                    <li class="list-group-item"><strong>Početak rezervacije:</strong> {{ $start_date ?? '-' }}</li>
                    <li class="list-group-item"><strong>Kraj rezervacije:</strong> {{ $end_date ?? '-' }}</li>
                </ul>

                <div class="justify-content-between d-flex align-items-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary align-self-end">← Nazad na rezultate</a>

                    <form action="{{ route('reservations.store') }}" method="POST"
                        class="d-flex justify-content-between align-items-end reservation-form" @style([
                            'width: 60%;' => !($start_date && $end_date),
                        ]) style="">
                        @csrf
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        @if ($start_date && $end_date)
                            <input type="hidden" name="start_date" value="{{ $start_date }}">
                            <input type="hidden" name="end_date" value="{{ $end_date }}">
                        @else
                            <div class="col-md-5">
                                <label for="start_date">Datum dolaska</label>
                                <input type="date" name="start_date" id="start_date" class="form-control start_date"
                                    value="{{ request('start_date') }}">
                            </div>

                            <div class="col-md-5">
                                <label for="end_date">Datum odlaska</label>
                                <input type="date" name="end_date" id="end_date" class="form-control end_date"
                                    value="{{ request('end_date') }}">
                            </div>
                        @endif
                        <button type="submit" class="btn btn-success" style="height: fit-content">Rezerviši</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Recenzije</h3>
            </div>
            @if (count($reviews) == 0)
                <div class="card-body">
                    <p class="text-muted mb-0">Nema recenzija</p>
                </div>
            @else
                <div class="card-body">
                    @foreach ($reviews as $review)
                        <div class="mb-3 border-bottom pb-2">
                            <div class="d-flex f-row align-items-center justify-content-between mb-1">
                                <strong class="me-2">{{ $review->user->name }}</strong>
                                <span class="badge bg-warning text-dark">{{ $review->rating }}/5</span>
                            </div>
                            <p class="mb-0">{{ $review->comment }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
