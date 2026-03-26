import React from "react";
import { useForm, Link } from "@inertiajs/react";

export default function Login() {
    const { data, setData, post, processing, errors } = useForm({
        email: "",
        password: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post("/login");
    };

    return (
        <div className="container mt-5" style={{ maxWidth: "400px" }}>
            <h2 className="mb-4 text-center">Prijava</h2>

            <form onSubmit={handleSubmit}>
                <div className="mb-3">
                    <label className="form-label">Email</label>
                    <input
                        type="email"
                        className="form-control"
                        value={data.email}
                        onChange={(e) => setData("email", e.target.value)}
                        required
                        autoFocus
                    />
                    {errors.email && (
                        <div className="text-danger small">{errors.email}</div>
                    )}
                </div>

                <div className="mb-3">
                    <label className="form-label">Lozinka</label>
                    <input
                        type="password"
                        className="form-control"
                        value={data.password}
                        onChange={(e) => setData("password", e.target.value)}
                        required
                    />
                    {errors.password && (
                        <div className="text-danger small">
                            {errors.password}
                        </div>
                    )}
                </div>

                <button
                    type="submit"
                    className="btn btn-success w-100"
                    disabled={processing}
                >
                    Uloguj se
                </button>
            </form>

            <div className="text-center mt-3">
                <Link href="/register">Nemaš nalog? Registruj se</Link>
            </div>
        </div>
    );
}
