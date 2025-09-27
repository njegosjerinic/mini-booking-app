@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dodaj recenziju za {{ $reservation->listing->name }}</h1>
            @auth
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="listin_id" value="{{ $reservation->listing->id }}">

                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

                        <div class="mb-3">
                            <label for="rating">Ocjena (1-5)</label>
                            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
                        </div>

                        <div class="mb-3">
                            <label for="comment">Komentar</label>
                            <textarea name="comment" id="comment" rows="3" class="form-control" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Posalji recenziju</button>
                    </form>
            @endauth
    </div>
@endsection