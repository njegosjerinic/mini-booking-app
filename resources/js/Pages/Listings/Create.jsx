import React from "react";
import { useForm, Link } from "@inertiajs/react";

export default function Create({ cities }) {
    const { data, setData, post, processing } = useForm({
        name: "",
        description: "",
        price_per_night: "",
        beds: "",
        max_persons: "",
        city_id: "",
        image_path: null,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post("/admin/listings");
    };

    return (
        <div className="container py-4">
            <h1 className="mb-4">Dodaj smeštaj</h1>

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
        </div>
    );
}
