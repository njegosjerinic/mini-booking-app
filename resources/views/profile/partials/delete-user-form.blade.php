<section class="space-y-8">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Obriši račun
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Kada vaš račun bude obrisan, svi njegovi resursi i podaci će biti trajno obrisani. Prije brisanja računa, preuzmite sve podatke ili informacije koje želite zadržati.
        </p>
    </header>

    <button type="button" class="rounded bg-danger border-0 p-md-2 text-white" onclick="showDeleteUserModal()">
        Obriši račun
    </button>
    <script>
        function showDeleteUserModal() {
            showModal({
                message: `
            <div class="mb-3">
                <p class="mb-3">Da li ste sigurni da želite da obrišete vaš nalog? Ova akcija je nepovratna.</p>
                <p class="text-muted small">Molimo unesite vašu lozinku da potvrdite brisanje.</p>
            </div>
            <form id="deleteUserForm" action="{{ route('profile.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                
                <div class="mb-3">
                    <label for="password" class="form-label">Lozinka</label>
                    <input type="password" 
                           class="form-control" 
                           id="password" 
                           name="password" 
                           required 
                           placeholder="Unesite vašu lozinku">
                </div>
                
                <div class="d-flex gap-2 justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Otkaži
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Obriši račun
                    </button>
                </div>
            </form>
        `,
                type: 'warning',
                hideFooter: true,
            });
        }
    </script>
</section>