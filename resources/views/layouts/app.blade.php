<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Booking App</title>

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>

<body>

    @include('partials.header')

    <div>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
    </div>

    <div id="modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notifikacija</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id='modal-body'>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let modalInstance = null;

        document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('modal');
            modalInstance = new bootstrap.Modal(modalElement);

            window.addEventListener('show-modal', function(event) {
                const {
                    message,
                    type,
                    hideFooter = false
                } = event.detail;

                const modalBody = document.getElementById('modal-body');
                modalBody.innerHTML = message;

                const modalHeader = modalElement.querySelector('.modal-header');
                modalHeader.className = 'modal-header';

                switch (type) {
                    case 'success':
                        modalHeader.classList.add('text-bg-success');
                        break;
                    case 'error':
                        modalHeader.classList.add('text-bg-danger');
                        break;
                    case 'warning':
                        modalHeader.classList.add('text-bg-warning');
                        break;
                }

                const modalFooter = document.querySelector('.modal-footer');

                if (hideFooter) {
                    modalFooter.style.display = 'none';
                } else {
                    modalFooter.style.display = 'flex';
                }

                modalInstance.show();
            });
        });

        function showModal(options) {
            window.dispatchEvent(new CustomEvent('show-modal', {
                detail: options
            }));
        }
    </script>

    @if(session('modal'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showModal({
                message: "{{ session('modal.message') }}",
                type: "{{ session('modal.type') }}",
            });
        });
    </script>
    @endif

    <main class="container mt-4">
        @yield('content')
    </main>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    </script>
</body>

</html>