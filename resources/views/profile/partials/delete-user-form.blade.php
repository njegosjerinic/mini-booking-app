<section class="space-y-8">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Obriši račun
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Kada vaš račun bude obrisan, svi njegovi resursi i podaci će biti trajno obrisani. Prije brisanja računa, preuzmite sve podatke ili informacije koje želite zadržati.
        </p>
    </header>

    <button type="button" class="rounded bg-danger border-0 p-md-2 text-white" x-data=""
        x-on:click="$dispatch('open-modal', 'confirm-user-deletion')">
        Obriši račun
    </button>

    <div x-data="{ show: @json($errors->userDeletion->isNotEmpty()) }" x-show="show"
        x-on:open-modal.window="if($event.detail === 'confirm-user-deletion') show = true"
        x-on:close.window="show = false"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" style="display: none;">
        <div class="bg-white rounded-lg w-full max-w-2xl p-12">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <h2 class="text-2xl font-semibold text-gray-900 mb-6">
                    Jeste li sigurni da želite obrisati svoj račun?
                </h2>
                <p class="m-1 text-base text-gray-600">
                    Kada vaš račun bude obrisan, svi njegovi resursi i podaci će biti trajno obrisani. Molimo unesite svoju lozinku da potvrdite da želite trajno obrisati svoj račun.
                </p>

                <div class="py-4">
                    <label for="password" class="sr-only">Lozinka</label>
                    <input id="password" name="password" type="password"
                        class="mt-1 block w-full border-gray-300 rounded-lg text-lg mb-6" placeholder="Lozinka" required />
                    @if ($errors->userDeletion->has('password'))
                        <div class="text-red-600 mt-2 text-base">
                            {{ $errors->userDeletion->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="flex justify-end">
                    <button type="button" class="rounded bg-success border-0 p-md-2 text-white"
                        x-on:click="$dispatch('close')">
                        Otkaži
                    </button>
                    <button type="submit" class="rounded bg-danger border-0 p-md-2 text-white">
                        Obriši račun
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
