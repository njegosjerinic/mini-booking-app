import React from "react";
import { usePage, Link, router } from "@inertiajs/react";

export default function Index() {
    const { users } = usePage().props;

    const handleDelete = (id) => {
        if (confirm("Da li si siguran da želiš obrisati korisnika?")) {
            router.delete(`/admin/users/${id}`);
        }
    };

    return (
        <div className="container">
            <h1>Lista korisnika</h1>

            <Link href="/admin/users/create" className="btn btn-success mb-3">
                Dodaj korisnika
            </Link>

            <table className="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ime</th>
                        <th>Email</th>
                        <th>Uloga</th>
                        <th>Datum registracije</th>
                        <th>Rezervacije</th>
                        <th>Akcije</th>
                    </tr>
                </thead>

                <tbody>
                    {users.map((user) => (
                        <tr key={user.id}>
                            <td>{user.id}</td>
                            <td>{user.name}</td>
                            <td>{user.email}</td>
                            <td>{user.role}</td>
                            <td>{user.created_at}</td>

                            <td>
                                {user.role !== "admin"
                                    ? user.reservations_count
                                    : "-"}
                            </td>

                            <td>
                                <Link
                                    href={`/admin/users/${user.id}/edit`}
                                    className="btn btn-sm btn-primary me-2"
                                >
                                    edit
                                </Link>

                                {user.role !== "admin" && (
                                    <button
                                        onClick={() => handleDelete(user.id)}
                                        className="btn btn-sm btn-danger"
                                    >
                                        Obrisati
                                    </button>
                                )}
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}
