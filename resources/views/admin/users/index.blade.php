@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista korisnika</h1>
        <a href="{{ route('admin.users.create') }}"></a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ime</th>
                    <th>Email</th>
                    <th>Uloga</th>
                    <th>Akcije</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">edit</a>
                            @if ($user->role !== 'admin')
                                <form id="delete-user-form-{{ $user->id }}" method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                    style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmDeleteUser({{ $user->id }})">Obrisati</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
