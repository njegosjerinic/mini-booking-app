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

                                @if ($reservation->end_date > now())
                                    <a class="mb-3 d-block"
                                        href="{{ route('reservations.reviews.create', $reservation->id) }}">Ostavi
                                        recenziju</a>
                                @endif
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                    class="btn btn-danger btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal" 
                                    data-id="{{ $reservation->id }}"
                                    class="btn btn-danger">Otkaži rezervaciju</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
