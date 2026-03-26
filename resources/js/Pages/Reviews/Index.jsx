import React from "react";

import { router, usePage } from "@inertiajs/react";

export default function AdminReviews() {
    const { reviews, filters } = usePage().props;

    const handleSearch = (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);

        router.get(route("admin.reviews.search"), {
            listing: formData.get("listing"),
        });
    };

    const handleDelete = (id) => {
        if (confirm("Jesi siguran da želiš obrisati recenziju?")) {
            router.delete(route("admin.reviews.destroy", id));
        }
    };

    return (
        <div className="container py-4">
            <form
                onSubmit={handleSearch}
                className="row g-3 mb-4 align-items-end justify-content-between review-form"
            >
                <div className="col-mb-3">
                    <label>Smjestaj</label>
                    <input
                        type="text"
                        name="listing"
                        defaultValue={filters?.listing || ""}
                        className="form-control"
                    />
                    <div id="suggestion-box"></div>
                </div>
            </form>

            <div className="card mb-4">
                <div className="card-header bg-primary text-white">
                    <h3 className="mb-0">Recenzije</h3>
                </div>

                {reviews.length === 0 ? (
                    <div className="card-body">
                        <p className="text-muted mb-0">Nema recenzija</p>
                    </div>
                ) : (
                    <div className="card-body">
                        {reviews.map((review) => (
                            <div
                                key={review.id}
                                className="mb-4 pb-3 border-bottom"
                            >
                                <div className="row align-items-center mb-2">
                                    <div className="col-md-3">
                                        <strong>{review.listing.name}</strong>
                                    </div>

                                    <div className="col-md-3">
                                        <strong>{review.user.name}</strong>
                                    </div>

                                    <div className="col-md-2">
                                        <span className="badge bg-warning text-dark">
                                            {review.rating}/5
                                        </span>
                                    </div>

                                    <div className="col-md-4 text-end">
                                        <button
                                            onClick={() =>
                                                handleDelete(review.id)
                                            }
                                            className="btn btn-sm btn-danger"
                                        >
                                            Obriši
                                        </button>
                                    </div>
                                </div>

                                <div className="row mb-2">
                                    <div className="col">
                                        <p className="mb-0">{review.comment}</p>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                )}
            </div>
        </div>
    );
}
