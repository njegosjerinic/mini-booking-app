import React from "react";
import { useForm, Link } from "@inertiajs/react";

export default function Create() {
    const { data, setData, post, processing, errors } = useForm({
        name: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post("/admin/cities");
    };

    return (
        <div className="container py-4">
            <h2>Dodaj grad</h2>

            <form onSubmit={handleSubmit}>
                <div className="mb-3">
                    <label>Naziv grada</label>
                    <input
                        type="text"
                        className="form-control"
                        placeholder="Unesi naziv grada"
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
                        Sačuvaj
                    </button>

                    <Link href="/admin/cities" className="btn btn-secondary">
                        Nazad
                    </Link>
                </div>
            </form>
        </div>
    );
}
