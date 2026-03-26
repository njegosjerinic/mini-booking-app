import React from "react";
import { Link, router } from "@inertiajs/react";

export default function Index({ cities }) {
    const handleDelete = (id) => {
        if (confirm("Da li si siguran da želiš obrisati grad?")) {
            router.delete(`/admin/cities/${id}`, {
                preserveScroll: true,
            });
        }
    };

    return (
        <div className="container py-4">
            <h2>Lista gradova</h2>

            <Link href="/admin/cities/create" className="btn btn-success mb-3">
                Dodaj novi grad
            </Link>

            <table className="table table-bordered">
                <thead>
                    <tr>
                        <th>Naziv</th>
                        <th>Smještaja</th>
                        <th>Akcije</th>
                    </tr>
                </thead>

                <tbody>
                    {cities.map((city) => (
                        <tr key={city.id}>
                            <td>{city.name}</td>
                            <td>{city.listings_count}</td>
                            <td>
                                <Link
                                    href={`/admin/cities/${city.id}/edit`}
                                    className="btn btn-warning btn-sm me-2"
                                >
                                    Izmjeni
                                </Link>

                                <button
                                    onClick={() => handleDelete(city.id)}
                                    className="btn btn-danger btn-sm"
                                >
                                    Obriši
                                </button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>

            <Link href="/admin/dashboard" className="btn btn-warning">
                Nazad
            </Link>
        </div>
    );
}
