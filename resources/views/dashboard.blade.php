<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Početna | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navigacija -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <div class="d-flex">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Sadržaj -->
     <form action="{{ route('listings.search') }}" method="GET" class="row g-3">
        <div class="col-md-3">
            <label for="city">Lokacija</label>
            <select name="city_id" id="city" class="form-control">
                <option value="">Izaberi lokaciju</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
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

        <div class="col-md-2">
            <label for="guests">Broj osoba</label>
            <input type="number" name="guests" id="guests" class="form-control" min="1">
        </div>

        <div class="col-md-1 align-self-end">
            <button type="submit" class="btn btn-primary w-100">Pretraži</button>
        </div>
    </form>

    <div class="container mt-5">
        <h1 class="mb-4">📋 Lista smeštaja</h1>

        @if($listings->isEmpty())
            <p>Trenutno nema dostupnih smeštaja.</p>
        @else
            <div class="row">
                @foreach($listings as $listing)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if($listing->image_path)
                                <img src="{{ asset('storage/'.$listing->image_path) }}" class="card-img-top" alt="{{ $listing->name }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $listing->name }}</h5>
                                <p class="card-text">{{ Str::limit($listing->description, 100) }}</p>
                                <p><strong>Grad:</strong> {{ $listing->city->name }}</p>
                                <p><strong>Cena:</strong> €{{ $listing->price_per_night }} / noć</p>
                                <a href="#" class="btn btn-primary">Detalji</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>

