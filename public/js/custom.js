document.querySelectorAll('.reservation-form').forEach(form => {
    let startInput = form.querySelector('.start_date');
    let endInput   = form.querySelector('.end_date');

    startInput.addEventListener('input', function () {
        // Set the minimum allowed date for end_date
        endInput.min = startInput.value;

        // If end_date is before start_date, reset it
        if (endInput.value < startInput.value) {
            endInput.value = startInput.value;
        }
    });
});

