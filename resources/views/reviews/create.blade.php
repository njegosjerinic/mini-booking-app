@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dodaj recenziju za {{ $reservation->listing->name }}</h1>
            @auth
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="listing_id" value="{{ $reservation->listing->id }}">

                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

                        <div class="mb-3">
                            <label for="rating">Ocjena (1-5)</label>
                            <div>
                                <input type="radio" name="rating" id="rating-1" value="1" required>
                                <label for="rating-1">1</label>
                                <input type="radio" name="rating" id="rating-2" value="2" required>
                                <label for="rating-2">2</label>
                                <input type="radio" name="rating" id="rating-3" value="3" required>
                                <label for="rating-3">3</label>
                                <input type="radio" name="rating" id="rating-4" value="4" required>
                                <label for="rating-4">4</label>
                                <input type="radio" name="rating" id="rating-5" value="5" required>
                                <label for="rating-5">5</label>
                            </div>
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