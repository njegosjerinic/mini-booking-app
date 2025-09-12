@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dodaj grad</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/admin/cities') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Naziv grada:</label>
            <input type="text" class="form-control" name="name" placeholder="Unesi naziv grada">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Sačuvaj</button>
    </form>
</div>
@endsection
