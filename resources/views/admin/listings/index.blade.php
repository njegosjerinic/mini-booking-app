@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upravljenje smještajem</h1>
    <a class="btn btn-success" href="{{ route('admin.listings.create') }}">Napravi smjestaj</a>

        <form action="{{ route('admin.listings.search') }}" method="GET" class="row g-3">
        <div class="col-md-3">
            <label for="city">Lokacija</label>
                <select name="city_id" id="city" class="form-control">
                    <option value="">Izaberi lokaciju</option>
                @foreach($cities as $c)
                    <option value="{{ $c->id }}" 
                        {{ request('city_id') == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
                </select>
        </div>

        <div class="col-md-3">
            <label for="checkin">Datum dolaska</label>
            <input type="date" name="checkin" id="checkin" class="form-control" value="{{ request('end_date') }}">
        </div>

        <div class="col-md-3">
            <label for="checkout">Datum odlaska</label>
            <input type="date" name="checkout" id="checkout" class="form-control" value="{{ request('start_date') }}">
        </div>

        <div class="col-md-2">
            <label for="guests">Broj osoba</label>
            <input type="number" name="guests" id="guests" class="form-control" min="1" value="{{ request('max_persons') }}">
        </div>

        <div class="col-md-1">
            <button type="submit" class="btn btn-primary" style="margin-top:30px">Pretraži</button>
        </div>
    </form>

    <div class="row">
        @foreach($listings as $l)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($l->image_path)
                        <img src="{{ asset('storage/'.$l->image_path) }}" class="card-img-top" alt="slika">
                    @else
                        <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="nema slike">
                    @endif

                    <div class="card-body">
                        <h5>{{ $l->name }}</h5>
                        <p>{{ $l->city->name ?? 'Nepoznato' }}</p>

                        <p><b>{{ $l->price_per_night }} €</b> / noć</p>
                        <p>{{ $l->beds }} kreveta, max {{ $l->max_persons }} osoba</p>

                        <a href="{{ route('admin.listings.edit', $l->id) }}" class="btn btn-sm btn-primary">
                            Detalji
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
