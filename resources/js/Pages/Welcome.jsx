import React from "react";
import { router, Link } from "@inertiajs/react";

export default function Welcome({ listings, cities }) {
    const handleSubmit = (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);

        router.get("/listings/search", Object.fromEntries(formData));
    };

    return (
        <div className="container py-4">
            {/* SEARCH FORM */}
            <form
                onSubmit={handleSubmit}
                className="row g-3 mb-4 align-items-end justify-content-between"
            >
                <div className="col-md-3">
                    <label>Lokacija</label>
                    <select name="city_id" className="form-control" required>
                        <option value="">Izaberi lokaciju</option>
                        {cities.map((c) => (
                            <option key={c.id} value={c.id}>
                                {c.name}
                            </option>
                        ))}
                    </select>
                </div>

                <div className="col-md-3">
                    <label>Datum dolaska</label>
                    <input
                        type="date"
                        name="start_date"
                        className="form-control"
                        min={new Date().toISOString().split("T")[0]}
                    />
                </div>

                <div className="col-md-3">
                    <label>Datum odlaska</label>
                    <input
                        type="date"
                        name="end_date"
                        className="form-control"
                    />
                </div>

                <div className="col-md-2">
                    <label>Broj osoba</label>
                    <input
                        type="number"
                        name="max_persons"
                        className="form-control"
                        min="1"
                        defaultValue={1}
                    />
                </div>

                <div className="col-md-1">
                    <button
                        type="submit"
                        className="btn btn-primary"
                        style={{ marginTop: "30px" }}
                    >
                        Pretraži
                    </button>
                </div>
            </form>

            {/* LISTINGS */}
            <div>
                <h1>Lista smještaja</h1>

                {listings.length === 0 ? (
                    <p>Nema smeštaja trenutno.</p>
                ) : (
                    <div className="row">
                        {listings.map((l) => (
                            <div key={l.id} className="col-md-4 mb-4">
                                <div className="card h-100">
                                    {l.image_path && (
                                        <img
                                            src={`/storage/${l.image_path}`}
                                            className="card-img-top"
                                            style={{
                                                height: "200px",
                                                objectFit: "cover",
                                            }}
                                            alt="slika"
                                        />
                                    )}

                                    <div className="card-body">
                                        <h5>{l.name}</h5>
                                        <p>
                                            {l.description?.substring(0, 100)}
                                            ...
                                        </p>
                                        <p>
                                            <b>Grad:</b> {l.city?.name}
                                        </p>
                                        <p>
                                            <b>Cena:</b> €{l.price_per_night} /
                                            noć
                                        </p>

                                        <Link
                                            href={`/listings/${l.id}`}
                                            className="btn btn-sm btn-primary"
                                        >
                                            Detalji
                                        </Link>
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
