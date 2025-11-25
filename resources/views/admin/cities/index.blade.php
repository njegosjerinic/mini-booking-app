@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lista gradova</h2>

        <a href="{{ url('/admin/cities/create') }}" class="btn btn-success mb-3">Dodaj novi grad</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Smjestaja</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cities as $city)
                    <tr>
                        <td>{{ $city->name }}</td>
                        <td>{{ $numberOfListings[$city->id] ?? 0 }}</td>
                        <td>
                            <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-warning btn-sm">Izmjeni</a>

                            <form id="delete-form-{{ $city->id }}"
                                action="{{ route('admin.cities.destroy', $city->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button onclick="confirmDelete({{ $city->id }})" type="button"
                                    class="btn btn-danger btn-sm">Obriši</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">Nazad</a>
    </div>
@endsection
