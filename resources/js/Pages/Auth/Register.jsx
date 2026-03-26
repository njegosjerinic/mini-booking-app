import React from "react";
import { useForm, Link } from "@inertiajs/react";

export default function Register() {
    const { data, setData, post, processing, errors } = useForm({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post("/register");
    };

    return (
        <div className="container mt-5" style={{ maxWidth: "450px" }}>
            <div className="card shadow-sm p-4">
                <h2 className="text-center mb-4">Registracija</h2>

                <form onSubmit={handleSubmit}>
                    {/* NAME */}
                    <div className="mb-3">
                        <label className="form-label">Ime</label>
                        <input
                            type="text"
                            className="form-control"
                            value={data.name}
                            onChange={(e) => setData("name", e.target.value)}
                            required
                            autoFocus
                        />
                        {errors.name && (
                            <div className="text-danger small">
                                {errors.name}
                            </div>
                        )}
                    </div>

                    {/* EMAIL */}
                    <div className="mb-3">
                        <label className="form-label">Email</label>
                        <input
                            type="email"
                            className="form-control"
                            value={data.email}
                            onChange={(e) => setData("email", e.target.value)}
                            required
                        />
                        {errors.email && (
                            <div className="text-danger small">
                                {errors.email}
                            </div>
                        )}
                    </div>

                    {/* PASSWORD */}
                    <div className="mb-3">
                        <label className="form-label">Lozinka</label>
                        <input
                            type="password"
                            className="form-control"
                            value={data.password}
                            onChange={(e) =>
                                setData("password", e.target.value)
                            }
                            required
                        />
                        {errors.password && (
                            <div className="text-danger small">
                                {errors.password}
                            </div>
                        )}
                    </div>

                    {/* CONFIRM */}
                    <div className="mb-3">
                        <label className="form-label">Potvrdi lozinku</label>
                        <input
                            type="password"
                            className="form-control"
                            value={data.password_confirmation}
                            onChange={(e) =>
                                setData("password_confirmation", e.target.value)
                            }
                            required
                        />
                        {errors.password_confirmation && (
                            <div className="text-danger small">
                                {errors.password_confirmation}
                            </div>
                        )}
                    </div>

                    {/* BUTTON */}
                    <button
                        type="submit"
                        className="btn btn-primary w-100"
                        disabled={processing}
                    >
                        Registruj se
                    </button>
                </form>

                {/* LOGIN LINK */}
                <div className="text-center mt-3">
                    <small>
                        Već imaš nalog? <Link href="/login">Uloguj se</Link>
                    </small>
                </div>
            </div>
        </div>
    );
}
