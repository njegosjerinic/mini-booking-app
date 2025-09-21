@extends('layouts.app')

@section('content')

    <form action="{{ url('/listings/search') }}" method="GET" class="row g-3 mb-4 align-items-end justify-content-between">
        <div class="col-md-3">
            <label for="city">Lokacija</label>
            <select required name="city_id" id="city" class="form-control">
                <option value="">Izaberi lokaciju</option>
                @foreach ($cities as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="checkin">Datum dolaska</label>
            <input type="date" name="checkin" id="checkin" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="checkout">Datum odlaska</label>
            <input type="date" name="checkout" id="checkout" class="form-control">
        </div>

        <div class="col-md-1">
            <label for="guests">Broj osoba</label>
            <input type="number" name="guests" id="guests" class="form-control" min="1">
        </div>

        <div style="max-width: fit-content;">
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
                                <a href="{{ url('login') }}" class="btn btn-sm btn-primary">Detalji</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
