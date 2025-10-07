@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Izmeni grad</h2>

    <form action="{{ route('admin.cities.update' , $city->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Naziv grada:</label>
            <input type="text" class="form-control" name="name" value="{{ $city->name }}">
        </div>

        <div class="justify-content-between d-flex align-items-center">
            <button type="submit" class="btn btn-primary mt-2">Ažuriraj</button>
            <a href="{{ route('admin.cities.index') }}" class="btn d-block">Nazad</a>
        </div>
    </form>
</div>
@endsection
