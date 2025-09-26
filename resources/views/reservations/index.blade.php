@extends('layouts.app')

@section('content')
<div>
    <h1>Lista rezervacija</h1>
    @if ($reservations->isEmpty())
        <p>Nema rezervacija trenutno</p>
    @else
        <div class="row">
            @foreach ($reservations as $reservation)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5>{{ $reservation->listing->name }}</h5>
                            <p>{{ $reservation->start_date }}</p>
                            <p>{{ $reservation->end_date }}</p>
                        
                            <a href="{{ route('reservations.reviews.create', $reservation->id) }}">Ostavi recenziju</a>
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Da li ste sigurni da želite obrisati ovu rezervaciju?')">
                                Obriši rezervaciju
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection