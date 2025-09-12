@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista gradova</h2>

    <a href="{{ url('/admin/cities/create') }}" class="btn btn-success mb-3">Dodaj novi grad</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Naziv</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cities as $city)
            <tr>
                <td>{{ $city->name }}</td>
                <td>
                    <a href="{{ url('/admin/cities/' . $city->id . '/edit') }}" class="btn btn-warning btn-sm">Izmeni</a>

                    <form action="{{ url('/admin/cities/' . $city->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Obriši</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

