@extends('layouts.app')

@section('content')
<div>
    <h1>Lista rezervacija</h1>
    @if ($admin_reservations->isEmpty())
        <p>Nema rezervacija trenutno</p>
    @else
        <div class="row">
            @foreach ($admin_reservations as $reservation)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5>{{ $reservation->listing->name }}</h5>
                            <p>Rezervisano od korisnika: {{ $reservation->user->name }}</p>
                            <p>{{ $reservation->start_date }}</p>
                            <p>{{ $reservation->end_date }}</p>
                            <form id="delete-reservation-form-{{ $reservation->id }}" action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDeleteReservation({{ $reservation->id }})" class="btn btn-danger">Obriši rezervaciju</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection