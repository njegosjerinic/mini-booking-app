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
                                <a href="{{ route('') }}" class="btn btn-primary">Detalji</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>
