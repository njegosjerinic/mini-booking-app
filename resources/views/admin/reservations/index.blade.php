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
                            <p>{{ $reservation->start_date }}</p>
                            <p>{{ $reservation->end_date }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection