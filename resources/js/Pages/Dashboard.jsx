import { usePage } from "@inertiajs/react";
import React from "react";

export default function Index() {
    const { listings, cities } = usePage().props;
    console.log("react radi");
    return (
        <div>
            <form
                method="GET"
                action="/listings/search"
                className="row g-3 mb-4 align-items-end justify-content-between reservation-form"
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

            <div>
                <h1>Lista smeštaja</h1>

                {listings.length === 0 ? (
                    <p>Nema smeštaja trenutno.</p>
                ) : (
                    <div className="row">
                        {listings.map((listing) => (
                            <div key={listing.id} className="col-md-4 mb-4">
                                <div className="card h-100">
                                    {listing.image_path && (
                                        <img
                                            src={`/storage/${listing.image_path}`}
                                            className="card-img-top object-fit-cover"
                                            style={{ height: "200px" }}
                                            alt="slika"
                                        />
                                    )}

                                    <div className="card-body">
                                        <h5>{listing.name}</h5>
                                        <p>
                                            {listing.description?.substring(
                                                0,
                                                100,
                                            )}
                                            ...
                                        </p>
                                        <p>
                                            <b>Grad:</b> {listing.city?.name}
                                        </p>
                                        <p>
                                            <b>Cena:</b> €
                                            {listing.price_per_night} / noć
                                        </p>
                                        <p>
                                            <b>Broj osoba:</b>{" "}
                                            {listing.max_persons}
                                        </p>

                                        <a
                                            href={`/listings/${listing.id}`}
                                            className="btn btn-sm btn-primary"
                                        >
                                            Detalji
                                        </a>
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
