@extends('layouts.app')

@section('content')

    <form action="{{ url('/listings/search') }}" method="GET" class="row g-3 mb-4 align-items-end justify-content-between reservation-form">
        <div class="col-md-3">
            <label for="city">Lokacija</label>
            <select required name="city_id" id="city" class="form-control">
                <option value="">Izaberi lokaciju</option>
                @foreach ($cities as $c)
                    <option value="{{ $c->id }}" {{ request('city_id') == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="start_date">Datum dolaska</label>
            <input type="date" name="start_date" id="start_date" class="form-control start_date"
               min="{{ now()->format('Y-m-d') }}" value="{{ request('start_date') }}">
        </div>

        <div class="col-md-3">
            <label for="end_date">Datum odlaska</label>
            <input type="date" name="end_date" id="end_date" class="form-control end_date" value="{{ request('end_date') }}">
        </div>

        <div class="col-md-2">
            <label for="max_persons">Broj osoba</label>
            <input type="number" name="max_persons" id="max_persons" class="form-control" min="1"
                value="{{ request('max_persons', 1) }}">
        </div>

        <div class="col-md-1">
            <button type="submit" class="btn btn-primary" style="margin-top:30px">Pretraži</button>
        </div>
    </form>

    <div>
        <h1>Lista smeštaja</h1>

        @if (count($listings) == 0)
            <p>Nema smeštaja trenutno.</p>
        @else
            <div class="row">
                @foreach ($listings as $l)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if ($l->image_path)
                                <img src="{{ asset('storage/' . $l->image_path) }}" class="card-img-top object-fit-cover"
                                    style="height: 200px;" alt="slika">
                            @endif
                            <div class="card-body">
                                <h5>{{ $l->name }}</h5>
                                <p>{{ substr($l->description, 0, 100) }}...</p>
                                <p><b>Grad:</b> {{ $l->city->name }}</p>
                                <p><b>Cena:</b> €{{ $l->price_per_night }} / noć</p>
                                <a href="{{ route('listings.show', $l->id) }}" class="btn btn-sm btn-primary">Detalji</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
