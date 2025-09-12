@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h1 class="mb-4">Admin Dashboard</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="list-group">
            <a href="{{ route('admin.cities.index') }}" class="list-group-item list-group-item-action">Upravljanje gradovima</a>
            <a href="{{ route('admin.listings.index') }}" class="list-group-item list-group-item-action">Upravljanje smeštajima</a>
            <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Upravljanje korisnicima</a>
            <a href="#" class="list-group-item list-group-item-action">Upravljanje rezervacijama</a>
            <a href="#" class="list-group-item list-group-item-action">Recenzije</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action text-danger">Logout</a>
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">User Dashboard</a>

        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
@endsection
