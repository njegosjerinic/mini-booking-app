<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Informacije o profilu
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Ažurirajte informacije o svom profilu i email adresu.
        </p>
    </header>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="name" class="block font-medium text-sm text-gray-700">Ime</label>
            <input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <span class="text-red-600 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <span class="text-red-600 text-sm mt-2">{{ $message }}</span>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        Vaša email adresa nije potvrđena.
                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Kliknite ovdje da ponovo pošaljete email za verifikaciju.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Novi link za verifikaciju je poslan na vašu email adresu.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="rounded bg-success border-0 p-md-2 text-white">
                Sačuvaj
            </button>
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Sačuvano.</p>
            @endif
        </div>
    </form>
</section>
