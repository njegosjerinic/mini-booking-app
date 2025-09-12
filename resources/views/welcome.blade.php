<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Početna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navigacija -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Booking</a>
            <ul class="navbar-nav">
                @guest
                    <a href="{{ url('login') }}" class="btn btn-outline-primary me-2">Login</a>
                    <a href="{{ url('register') }}" class="btn btn-primary">Register</a>
                @else
                    <form method="POST" action="{{ url('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Lista smeštaja</h1>

        @if(count($listings) == 0)
            <p>Nema smeštaja trenutno.</p>
        @else
            <div class="row">
                @foreach($listings as $l)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if($l->image_path)
                                <img src="{{ asset('storage/'.$l->image_path) }}" class="card-img-top" alt="slika">
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

</body>
</html>
