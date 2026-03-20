<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Booking App</title>

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @viteReactRefresh
@vite('resources/js/app.jsx')
@inertiaHead

</head>

<body>

    @include('partials.header')


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
                    <button type="submit" id="confirm-delete-btn" class="btn btn-danger d-none">Obrisi</button>
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
                    hideFooter = false,
                    confirmAction = null
                } = event.detail;

                const modalBody = document.getElementById('modal-body');
                const modalHeader = modalElement.querySelector('.modal-header');
                const modalFooter = modalElement.querySelector('.modal-footer');
                const confirmBtn = document.getElementById('confirm-delete-btn');

                modalBody.innerHTML = message;
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

                if (hideFooter) {
                    modalFooter.style.display = 'none';
                } else {
                    modalFooter.style.display = 'flex';
                }

                if (confirmAction) {
                    confirmBtn.classList.remove('d-none');
                    confirmBtn.onclick = function() {
                        confirmAction();
                        modalInstance.hide();
                    };
                } else {
                    confirmBtn.classList.add('d-none');
                    confirmBtn.onclick = null;
                }

                modalInstance.show();
            });
        });

        function showModal(options) {
            window.dispatchEvent(new CustomEvent('show-modal', {
                detail: options
            }));
        }

        function confirmDelete(id){
            toastr.clear();
            toastr.options.timeOut = 0;
            toastr.options.preventDuplicates = true;

            showModal({
                message: "Da li ste sigurni da zelite obrisati ovaj grad ",
                type: "warning",
                confirmAction: ()=>{
                    console.log(document.getElementById(`delete-form-${id}`))
                    document.getElementById(`delete-form-${id}`).submit();
                }
            })
        }

        function confirmDeleteListing(id){
            toastr.clear();
            toastr.options.timeOut = 0;
            toastr.options.preventDuplicates = true;
            
            showModal({
                message: "Da li ste sigurni da želite obrisati ovaj smještaj?",
                type: "warning",
                confirmAction: ()=>{
                    document.getElementById(`delete-listing-form-${id}`).submit();
                }
            })
        }

        function confirmDeleteReservation(id){
            toastr.clear();
            toastr.options.timeOut = 0;
            toastr.options.preventDuplicates = true;

            showModal({
                message: "Da li ste sigurni da želite obrisati ovu rezervaciju?",
                type: "warning",
                confirmAction: ()=>{
                    document.getElementById(`delete-reservation-form-${id}`).submit();
                }
            })
        }

        function confirmDeleteReview(id){
            toastr.clear();
            toastr.options.timeOut = 0;
            toastr.options.preventDuplicates = true;

            showModal({
                message: "Da li ste sigurni da želite obrisati ovu recenziju?",
                type: "warning",
                confirmAction: ()=>{
                    document.getElementById(`delete-review-form-${id}`).submit();
                }
            })
        }
        
        function confirmDeleteUser(id){
            toastr.clear();
            toastr.options.timeOut = 0;
            toastr.options.preventDuplicates = true;

            showModal({
                message: "Da li ste sigurni da želite obrisati ovog korisnika?",
                type: "warning",
                confirmAction: ()=>{
                    document.getElementById(`delete-user-form-${id}`).submit();
                }
            })
        }
    </script>
    <main class="container mt-4">
        @inertia
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "100",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "show",
            "hideMethod": "hide"
        };
    </script>

    <!-- Tvoj custom JS -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    </script>


</body>

</html>
