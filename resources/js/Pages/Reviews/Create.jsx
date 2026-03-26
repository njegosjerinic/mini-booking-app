import React from "react";

import { useForm, usePage } from "@inertiajs/react";

export default function CreateReview({ reservation }) {
    const { auth } = usePage().props;
    const user = auth?.user;

    const { data, setData, post, processing, errors } = useForm({
        listing_id: reservation.listing.id,
        reservation_id: reservation.id,
        rating: "",
        comment: "",
    });

    const submit = (e) => {
        e.preventDefault();
        console.log("SUBMIT RADI");
        console.log(data);

        post("/reviews", {
            preserveScroll: true,
        });
    };

    return (
        <div className="container py-4">
            <h1>Dodaj recenziju za {reservation.listing?.name}</h1>

            {user && (
                <form onSubmit={submit}>
                    {/* rating */}
                    <div className="mb-3">
                        <label>Ocjena (1-5)</label>
                        <div>
                            {[1, 2, 3, 4, 5].map((num) => (
                                <label key={num} className="me-2">
                                    <input
                                        type="radio"
                                        name="rating"
                                        value={num}
                                        checked={data.rating == num}
                                        onChange={(e) =>
                                            setData("rating", e.target.value)
                                        }
                                        required
                                    />
                                    {num}
                                </label>
                            ))}
                        </div>
                        {errors.rating && <div>{errors.rating}</div>}
                    </div>

                    {/* comment */}
                    <div className="mb-3">
                        <label>Komentar</label>
                        <textarea
                            value={data.comment}
                            onChange={(e) => setData("comment", e.target.value)}
                            rows="3"
                            className="form-control"
                            required
                        />
                        {errors.comment && <div>{errors.comment}</div>}
                    </div>

                    <button
                        type="submit"
                        disabled={processing}
                        className="btn btn-primary"
                    >
                        Pošalji recenziju
                    </button>
                </form>
            )}
        </div>
    );
}
