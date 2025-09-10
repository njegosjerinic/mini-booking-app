<x-guest-layout>
    <div class="container mt-5">
        <h2 class="mb-4">Prijava</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Lozinka</label>
                <input id="password" type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Uloguj se</button>
        </form>
    </div>
</x-guest-layout>

