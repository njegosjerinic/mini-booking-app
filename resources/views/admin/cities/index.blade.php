@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Lista gradova</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.cities.create') }}" class="btn btn-primary mb-3">➕ Dodaj grad</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Naziv</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cities as $city)
                <tr>
                    <td>{{ $city->name }}</td>
                    <td>
                        <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Obrisati grad?')">🗑 Obrisi</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nema unetih gradova.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
