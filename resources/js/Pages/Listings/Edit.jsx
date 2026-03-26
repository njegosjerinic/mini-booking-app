import React from "react";
import { useForm, Link } from "@inertiajs/react";

export default function Edit({ listing, cities }) {
    const { data, setData, post, processing } = useForm({
        name: listing.name || "",
        description: listing.description || "",
        price_per_night: listing.price_per_night || "",
        beds: listing.beds || "",
        max_persons: listing.max_persons || "",
        city_id: listing.city_id || "",
        image_path: null,
        _method: "put",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(`/admin/listings/${listing.id}`);
    };

    const handleDelete = () => {
        if (confirm("Da li si siguran da želiš obrisati?")) {
            post(`/admin/listings/${listing.id}`, {
                _method: "delete",
            });
        }
    };

    return (
        <div className="container py-4">
            <h1 className="mb-4">Uredi smeštaj</h1>

            <form onSubmit={handleSubmit} encType="multipart/form-data">
                <div className="mb-3">
                    <label className="form-label">Naziv smještaja</label>
                    <input
                        type="text"
                        className="form-control"
                        value={data.name}
                        onChange={(e) => setData("name", e.target.value)}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label className="form-label">Opis</label>
                    <textarea
                        className="form-control"
                        rows="4"
                        value={data.description}
                        onChange={(e) => setData("description", e.target.value)}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label className="form-label">Cjena po noći (€)</label>
                    <input
                        type="number"
                        className="form-control"
                        value={data.price_per_night}
                        onChange={(e) =>
                            setData("price_per_night", e.target.value)
                        }
                        required
                    />
                </div>

                <div className="mb-3">
                    <label className="form-label">Broj kreveta</label>
                    <input
                        type="number"
                        className="form-control"
                        value={data.beds}
                        onChange={(e) => setData("beds", e.target.value)}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label className="form-label">Maksimalan broj osoba</label>
                    <input
                        type="number"
                        className="form-control"
                        value={data.max_persons}
                        onChange={(e) => setData("max_persons", e.target.value)}
                        required
                    />
                </div>

                <div className="mb-3">
                    <label className="form-label">Grad</label>
                    <select
                        className="form-control"
                        value={data.city_id}
                        onChange={(e) => setData("city_id", e.target.value)}
                        required
                    >
                        {cities.map((city) => (
                            <option key={city.id} value={city.id}>
                                {city.name}
                            </option>
                        ))}
                    </select>
                </div>

                <div className="mb-3">
                    <label className="form-label">Slika (opciono)</label>
                    <input
                        type="file"
                        className="form-control"
                        accept="image/*"
                        onChange={(e) =>
                            setData("image_path", e.target.files[0])
                        }
                    />

                    {listing.image_path && (
                        <div
                            className="mt-2 position-relative w-100"
                            style={{ height: "200px" }}
                        >
                            <img
                                src={`/storage/${listing.image_path}`}
                                className="position-absolute h-100 w-100"
                                style={{ objectFit: "cover", inset: 0 }}
                                alt="slika"
                            />
                        </div>
                    )}
                </div>

                <div className="d-flex justify-content-between align-items-center">
                    <button
                        type="submit"
                        className="btn btn-success"
                        disabled={processing}
                    >
                        Sačuvaj izmene
                    </button>

                    <Link href="/admin/listings" className="btn btn-secondary">
                        Nazad
                    </Link>
                </div>
            </form>

            {/* DELETE */}
            <div className="mt-3">
                <button onClick={handleDelete} className="btn btn-danger">
                    Obriši smještaj
                </button>
            </div>
        </div>
    );
}
