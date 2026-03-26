import React from "react";
import { useForm, Link } from "@inertiajs/react";

export default function Edit({ user }) {
    const { data, setData, post, processing, errors } = useForm({
        name: user.name || "",
        email: user.email || "",
        role: user.role || "",
        _method: "put",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(`/admin/users/${user.id}`);
    };

    return (
        <div className="container">
            <h1>Uredi korisnika</h1>

            <form onSubmit={handleSubmit}>
                <div className="mb-3">
                    <label>Ime i prezime</label>
                    <input
                        type="text"
                        className="form-control"
                        value={data.name}
                        onChange={(e) => setData("name", e.target.value)}
                        required
                    />
                    {errors.name && <div>{errors.name}</div>}
                </div>

                <div className="mb-3">
                    <label>Email adresa</label>
                    <input
                        type="email"
                        className="form-control"
                        value={data.email}
                        onChange={(e) => setData("email", e.target.value)}
                        required
                    />
                    {errors.email && <div>{errors.email}</div>}
                </div>

                <div className="mb-3">
                    <label>Uloga</label>
                    <select
                        className="form-control"
                        value={data.role}
                        onChange={(e) => setData("role", e.target.value)}
                        required
                    >
                        <option value="user">Korisnik</option>
                        <option value="admin">Administrator</option>
                    </select>
                    {errors.role && <div>{errors.role}</div>}
                </div>

                <div className="d-flex justify-content-between align-items-center">
                    <button
                        type="submit"
                        className="btn btn-success"
                        disabled={processing}
                    >
                        Sačuvaj izmene
                    </button>

                    <Link href="/admin/users" className="btn btn-secondary">
                        Nazad
                    </Link>
                </div>
            </form>
        </div>
    );
}
