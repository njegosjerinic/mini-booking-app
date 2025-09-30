@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg p-4">
        <h1 class="mb-4">Admin Dashboard</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="list-group">
            <a href="{{ route('admin.cities.index') }}" class="list-group-item list-group-item-action">Upravljanje Gradovima</a>
            <a href="{{ route('admin.listings.index') }}" class="list-group-item list-group-item-action">Upravljanje Smeštajima</a>
            <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Upravljanje Korisnicima</a>
            <a href="{{ route('admin.reservations.index') }}" class="list-group-item list-group-item-action">Upravljanje Rezervacijama</a>
            <a href="{{ route('admin.reviews.index') }}" class="list-group-item list-group-item-action">Upravljanje Recenzijama</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action text-danger">Logout</a>

        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
@endsection
