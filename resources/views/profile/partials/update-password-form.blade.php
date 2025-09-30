<section>
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">
            Ažuriraj Lozinku
        </h2>

        <p class="mt-2 text-base text-gray-600">
            Osigurajte da vaš nalog koristi dugu, nasumičnu lozinku radi sigurnosti.
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="current_password" class="block font-medium text-sm text-gray-700">Current Password</label>
            <input id="current_password" name="current_password" type="password" class="mt-1 d-block w-full"
                autocomplete="current-password">
            @error('current_password')
                <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block font-medium text-sm text-gray-700">New Password</label>
            <input id="password" name="password" type="password" class="mt-1 d-block w-full"
                autocomplete="new-password">
            @error('password')
                <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 d-block w-full"
                autocomplete="new-password">
            @error('password_confirmation')
                <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="rounded bg-success border-0 p-md-2 text-white">
                Sačuvaj
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">Sacuvano.</p>
            @endif
        </div>
    </form>
</section>
