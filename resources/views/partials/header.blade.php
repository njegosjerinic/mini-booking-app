<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">MiniBooking</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.cities.index') }}">Upravljanje Gradovima</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.listings.index') }}">Upravljanje Smjestajima</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">Upravljanje korisnicima</a>
                        </li>
                    @elseif(auth()->user()->role === 'user')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Pocetna</a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link" href="#">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservations.index') }}">Rezervacije</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Registracija</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
