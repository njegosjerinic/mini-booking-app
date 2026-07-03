document.addEventListener("DOMContentLoaded", function () {
    let timeoutId = null;

    document.querySelectorAll(".reservation-form").forEach((form) => {
        const startInput = form.querySelector(".start_date");
        const endInput = form.querySelector(".end_date");

        if (startInput && endInput) {
            startInput.addEventListener("input", function () {
                endInput.min = startInput.value;

                if (endInput.value < startInput.value) {
                    endInput.value = startInput.value;
                }
            });
        }
    });

    const searchInput = document.getElementById("searchListing");
    const searchResults = document.getElementById("searchResults");

    if (searchInput && searchResults) {
        searchInput.addEventListener("keyup", function () {
            clearTimeout(timeoutId);

            const query = this.value.trim();

            if (query.length > 2) {
                timeoutId = setTimeout(() => {
                    fetchSearchResults(query);
                }, 400);
            } else {
                searchResults.innerHTML = "";
            }
        });
    }

    async function fetchSearchResults(query) {
        try {
            const response = await fetch(
                `/listings/search?query=${encodeURIComponent(query)}`,
            );

            if (!response.ok) {
                throw new Error("Greška prilikom pretrage");
            }

            const html = await response.text();
            searchResults.innerHTML = html;
        } catch (error) {
            console.error(error);
            searchResults.innerHTML =
                "<p class='text-danger'>Došlo je do greške.</p>";
        }
    }
});
