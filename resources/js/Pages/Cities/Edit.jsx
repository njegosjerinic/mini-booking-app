import React from "react";
import { useForm, Link } from "@inertiajs/react";

export default function Edit({ city }) {
    const { data, setData, put, processing, errors } = useForm({
        name: city.name || "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        put(`/admin/cities/${city.id}`);
    };

    return (
        <div className="container py-4">
            <h2>Izmeni grad</h2>

            <form onSubmit={handleSubmit}>
                <div className="mb-3">
                    <label>Naziv grada</label>
                    <input
                        type="text"
                        className="form-control"
                        value={data.name}
                        onChange={(e) => setData("name", e.target.value)}
                    />
                    {errors.name && (
                        <div className="text-danger small">{errors.name}</div>
                    )}
                </div>

                <div className="d-flex justify-content-between">
                    <button
                        type="submit"
                        className="btn btn-primary"
                        disabled={processing}
                    >
                        Ažuriraj
                    </button>

                    <Link href="/admin/cities" className="btn btn-secondary">
                        Nazad
                    </Link>
                </div>
            </form>
        </div>
    );
}
