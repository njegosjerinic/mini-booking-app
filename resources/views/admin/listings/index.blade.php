@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ponuda smeštaja</h1>

    <div class="row">
        @foreach($listings as $l)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <!-- slika -->
                    @if($l->image_path)
                        <img src="{{ asset('storage/'.$l->image) }}" class="card-img-top" alt="slika">
                    @else
                        <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="nema slike">
                    @endif

                    <div class="card-body">
                        <h5>{{ $l->name }}</h5>
                        <p>{{ $l->city->name ?? 'Nepoznato' }}</p>

                        <p><b>{{ $l->price_per_night }} €</b> / noć</p>
                        <p>{{ $l->beds }} kreveta, max {{ $l->max_persons }} osoba</p>

                        <a href="/admin/listings/{{ $l->id }}/edit" class="btn btn-sm btn-primary">
                            Detalji
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
