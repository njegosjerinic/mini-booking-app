import React from "react";
import { useForm, Link } from "@inertiajs/react";

export default function Show({ listing, start_date, end_date }) {
    const { data, setData, post, processing } = useForm({
        listing_id: listing.id,
        start_date: start_date || "",
        end_date: end_date || "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post("/reservations");
    };

    return (
        <div className="container py-4">
            {/* LISTING */}
            <div className="card mb-4">
                {listing.image_path && (
                    <img
                        src={`/storage/${listing.image_path}`}
                        className="card-img-top"
                        style={{ height: "400px", objectFit: "cover" }}
                        alt={listing.name}
                    />
                )}

                <div className="card-body">
                    <h2>{listing.name}</h2>
                    <p>{listing.description}</p>

                    <ul className="list-group mb-3">
                        <li className="list-group-item">
                            <strong>Grad:</strong> {listing.city?.name}
                        </li>
                        <li className="list-group-item">
                            <strong>Maksimalno gostiju:</strong>{" "}
                            {listing.max_persons}
                        </li>
                        <li className="list-group-item">
                            <strong>Cena po noći:</strong> €
                            {listing.price_per_night}
                        </li>
                        <li className="list-group-item">
                            <strong>Početak rezervacije:</strong>{" "}
                            {start_date || "-"}
                        </li>
                        <li className="list-group-item">
                            <strong>Kraj rezervacije:</strong> {end_date || "-"}
                        </li>
                    </ul>

                    <div className="d-flex justify-content-between align-items-end">
                        <Link href="/" className="btn btn-secondary">
                            ← Nazad
                        </Link>

                        {/* REZERVACIJA */}
                        <form
                            onSubmit={handleSubmit}
                            className="d-flex gap-2 align-items-end"
                        >
                            {!start_date || !end_date ? (
                                <>
                                    <div>
                                        <label>Datum dolaska</label>
                                        <input
                                            type="date"
                                            className="form-control"
                                            value={data.start_date}
                                            onChange={(e) =>
                                                setData(
                                                    "start_date",
                                                    e.target.value,
                                                )
                                            }
                                        />
                                    </div>

                                    <div>
                                        <label>Datum odlaska</label>
                                        <input
                                            type="date"
                                            className="form-control"
                                            value={data.end_date}
                                            onChange={(e) =>
                                                setData(
                                                    "end_date",
                                                    e.target.value,
                                                )
                                            }
                                        />
                                    </div>
                                </>
                            ) : (
                                <>
                                    <input
                                        type="hidden"
                                        value={data.start_date}
                                    />
                                    <input
                                        type="hidden"
                                        value={data.end_date}
                                    />
                                </>
                            )}

                            <button
                                type="submit"
                                className="btn btn-success"
                                disabled={processing}
                            >
                                Rezerviši
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {/* REVIEWS */}
            <div className="card mb-4">
                <div className="card-header bg-primary text-white">
                    <h3 className="mb-0">Recenzije</h3>
                </div>

                {listing.reviews.length === 0 ? (
                    <div className="card-body">
                        <p className="text-muted mb-0">Nema recenzija</p>
                    </div>
                ) : (
                    <div className="card-body">
                        {listing.reviews.map((review) => (
                            <div
                                key={review.id}
                                className="mb-3 border-bottom pb-2"
                            >
                                <div className="d-flex justify-content-between mb-1">
                                    <strong>{review.user?.name}</strong>
                                    <span className="badge bg-warning text-dark">
                                        {review.rating}/5
                                    </span>
                                </div>
                                <p className="mb-0">{review.comment}</p>
                            </div>
                        ))}
                    </div>
                )}
            </div>
        </div>
    );
}
